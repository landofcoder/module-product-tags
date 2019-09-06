<?php
namespace Lof\ProductTags\Model\ResourceModel\Tag;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'tag_id';
    protected function _construct()
    {
        $this->_init(
            \Lof\ProductTags\Model\Tag::class,
            \Lof\ProductTags\Model\ResourceModel\Tag::class
        );
    }
}
