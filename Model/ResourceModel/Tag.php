<?php
namespace Lof\ProductTags\Model\ResourceModel;
use Magento\Framework\Model\AbstractModel;
use Magento\Catalog\Model\Indexer\Category\Product\Processor;
use Magento\Framework\DataObject;
use Magento\Framework\EntityManager\EntityManager;
use Magento\Eav\Model\Entity\Attribute\UniqueValidationInterface;

class Tag extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_tagProductTable = '';
    
    protected function _construct()
    {
        $this->_init('lof_producttags_tag', 'tag_id');
    }

    /**
     * Process page data after saving
     *
     * @param AbstractModel $object
     * @return $this
     * @throws LocalizedException
     */
    protected function _afterSave(AbstractModel $object)
    {
        $this->_saveTagProducts($object);
        return parent::_afterSave($object);
    }

     public function getTagProductTable()
    {
        if (!$this->_tagProductTable) {
            $this->_tagProductTable = $this->getTable('lof_producttags_product');
        }
        return $this->_tagProductTable;
    }

    protected function _saveTagProducts($tag)
    {
        $tag->setIsChangedProductList(false);
        $id = $tag->getId();

        /**
         * new tag-product relationships
         */
        $products = $tag->getPostedProducts();
        /**
         * Example re-save category
         */
        if ($products === null) {
            return $this;
        }

        /**
         * old category-product relationships
         */
        $oldProducts = $tag->getProductsPosition();

        $insert = array_diff_key($products, $oldProducts);
        $delete = array_diff_key($oldProducts, $products);

        /**
         * Find product ids which are presented in both arrays
         * and saved before (check $oldProducts array)
         */
        $update = array_intersect_key($products, $oldProducts);
        $update = array_diff_assoc($update, $oldProducts);

        $connection = $this->getConnection();

         /**
         * Delete products from tag
         */
        if (!empty($delete)) {
            $cond = ['product_id IN(?)' => array_keys($delete), 'tag_id=?' => $id];
            $connection->delete($this->getTagProductTable(), $cond);
        }

        /**
         * Add products to tag
         */
        if (!empty($insert)) {
            $data = [];
            foreach ($insert as $productId => $position) {
                $data[] = [
                    'tag_id' => (int)$id,
                    'product_id' => (int)$productId,
                    'position' => (int)$position,
                ];
            }
            $connection->insertMultiple($this->getTagProductTable(), $data);
        }

        /**
         * Update product positions in category
         */
        if (!empty($update)) {
            $newPositions = [];
            foreach ($update as $productId => $position) {
                $delta = $position - $oldProducts[$productId];
                if (!isset($newPositions[$delta])) {
                    $newPositions[$delta] = [];
                }
                $newPositions[$delta][] = $productId;
            }

            foreach ($newPositions as $delta => $productIds) {
                $bind = ['position' => new \Zend_Db_Expr("position + ({$delta})")];
                $where = ['tag_id = ?' => (int)$id, 'product_id IN (?)' => $productIds];
                $connection->update($this->getTagProductTable(), $bind, $where);
            }
        }
        if (!empty($insert) || !empty($delete)) {
            $productIds = array_unique(array_merge(array_keys($insert), array_keys($delete)));
            $tag->setChangedProductIds($productIds);
        }

        if (!empty($insert) || !empty($update) || !empty($delete)) {
            $tag->setIsChangedProductList(true);

            /**
             * Setting affected products to tag for third party engine index refresh
             */
            $productIds = array_keys($insert + $delete + $update);
            $tag->setAffectedProductIds($productIds);
        }

        return $this;
    }
    /**
     * Get positions of associated to tag products
     *
     * @param \Lof\ProductTags\Model\Tag $tag
     * @return array
     */
    public function getProductsPosition($tag)
    {
        $select = $this->getConnection()->select()->from(
            $this->getTagProductTable(),
            ['product_id', 'position']
        )->where(
            "{$this->getTable('lof_producttags_product')}.tag_id = ?",
            (int)$tag->getId()
        );

        $bind = ['tag_id' => (int)$tag->getId()];

        return $this->getConnection()->fetchPairs($select, $bind);
    }
}