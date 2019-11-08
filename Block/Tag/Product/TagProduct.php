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

namespace Lof\ProductTags\Block\Tag\Product;

class TagProduct extends \Magento\Framework\View\Element\Template
{
    protected $resultPageFactory;

    protected $_tagFactory;

    protected $_tagcollection;

    protected $_tagHelper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Lof\ProductTags\Model\TagFactory $tagFactory,
        \Lof\ProductTags\Helper\Data $tagdata,
        array $data = []
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_tagFactory = $tagFactory;
        $this->_tagHelper = $tagdata;
        parent::__construct($context, $data);
    }
    public function _toHtml(){
        if(!$this->_tagHelper->getGeneralConfig('enabled')) return;
        if(!$this->_tagHelper->getGeneralConfig('enable_tag_on_product')) return;
        $_tag_collection = $this->getTagCollection();
        if($_tag_collection && $_tag_collection->getSize()){
            return parent::_toHtml();
        }
        return "";
    }
    function getTagHelper(){
        return $this->_tagHelper;
    }
    public function getTagCollection()
    {
        if(!$this->_tagcollection){
            $limit = $this->_tagHelper->getGeneralConfig('number_tags');
            $limit = $limit?(int)$limit:10;
            $tag = $this->_tagFactory->create();
            $collection = $tag->getCollection();
            $collection->addFieldToFilter("status", 1);
            $collection->setOrder("tag_id","DESC");
            $collection->setPageSize($limit);
            //$collection->setLimit($limit);
            $this->_tagcollection = $collection;
        }
        return $this->_tagcollection;
    }
}
