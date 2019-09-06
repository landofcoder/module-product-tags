<?php
/**
 * Copyright (c) 2019  Landofcoder
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Lof\ProductTags\Model\ResourceModel;

class Tag extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected $_tagProductTable;
    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('lof_producttags_tag', 'tag_id');
    }
     /**
     * Category product table name getter
     *
     * @return string
     */
    public function getTagProductTable()
    {
        if (!$this->_tagProductTable) {
            $this->_tagProductTable = $this->getTable('lof_producttags_product');
        }
        return $this->_tagProductTable;
    }
    /**
     * Get positions of associated to category products
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
            $tag->getId()
        );
        $bind = ['tag_id' => (int)$tag->getId()];

        return $this->getConnection()->fetchPairs($select, $bind);
    }
}
