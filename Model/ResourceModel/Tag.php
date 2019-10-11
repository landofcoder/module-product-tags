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
    protected function _afterSave($tag)
    {
        $this->_saveTagProducts($tag);
        $this->_saveTagStores($tag);
        return parent::_afterSave($tag);
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

        $productCount = $this->getProductCount($tag);
        $tableName = $this->getTable('lof_producttags_tag'); //gives table name with prefix
        $connection->update(
            ['main_table' => $tableName],
            ['number_products' => (int)$productCount],['tag_id = ?' => (int)$id]);
        return $this;
    }
    /**
     * Count product selected on Product Tags
     */
    public function getProductCount($tag)
    {
        $productTable = $this->getTable('lof_producttags_product');

        $select = $this->getConnection()->select()->from(
            ['main_table' => $productTable],
            [new \Zend_Db_Expr('COUNT(main_table.product_id)')]
        )->where(
            'main_table.tag_id = :tag_id'
        );

        $bind = ['tag_id' => (int)$tag->getId()];
        $counts = $this->getConnection()->fetchOne($select, $bind);

        return intval($counts);
    }

    /**
     * Save Tag Store
     */
    protected function _saveTagStores($tag)
    {
        $oldStores = $this->lookupStoreIds($tag->getId());
        $newStores = (array)$tag->getStores();
        if (empty($newStores)) {
            $newStores = (array)$tag->getStoreId();
        }
        $table = $this->getTable('lof_producttags_store');
        $insert = array_diff($newStores, $oldStores);
        $delete = array_diff($oldStores, $newStores);
        if ($delete) {
            $where = ['tag_id = ?' => (int)$object->getId(), 'store_id IN (?)' => $delete];
            $this->getConnection()->delete($table, $where);
        }
        if ($insert) {
            $data = [];
            foreach ($insert as $storeId) {
                $data[] = ['tag_id' => (int)$tag->getId(), 'store_id' => (int)$storeId];
            }
            $this->getConnection()->insertMultiple($table, $data);
        }
        return $this;
    }

    /**
     * Perform operations after object load
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function _afterLoad(\Magento\Framework\Model\AbstractModel $object)
    {
        if ($object->getId()) {
            $stores = $this->lookupStoreIds($object->getId());
            $object->setData('store_id', $stores);
            // $productCount = $this->getProductCount($object);
            // print_r($productCount);die();
        }
        return parent::_afterLoad($object);
    }
    /**
     * Get store ids to which specified item is assigned
     *
     * @param int $tagId
     * @return array
     */
    public function lookupStoreIds($tagId)
    {
        $connection = $this->getConnection();
        $select = $connection->select()->from(
            $this->getTable('lof_producttags_store'),
            'store_id'
            )
        ->where(
            'tag_id = ?',
            (int)$tagId
            );
        return $connection->fetchCol($select);
    }
     /**
     * Process brand data before deleting
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    protected function _beforeDelete(\Magento\Framework\Model\AbstractModel $object)
    {
        $condition = ['tag_id = ?' => (int)$object->getId()];
        $this->getConnection()->delete($this->getTable('lof_producttags_store'), $condition);
        $condition = ['tag_id = ?' => (int)$object->getId()];
        $this->getConnection()->delete($this->getTable('lof_producttags_product'), $condition);
        return parent::_beforeDelete($object);
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
    public function getTagIdByIdentifier($tag_code = ""){
        if($tag_code) {
            $tag_code = str_replace(array('"',"'"),"", $tag_code);
            $tag_code = trim($tag_code);
            $select = $this->getConnection()->select()->from(
                $this->getTable("lof_producttags_tag"),
                ['tag_id']
            )->where(
                "{$this->getTable('lof_producttags_tag')}.identifier = ?",
                $tag_code
            );

            return $this->getConnection()->fetchOne($select);
        }
        return false;
    }
}
