<?php
namespace Lof\ProductTags\Model\ResourceModel;

class Tag extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('lof_producttags_tag', 'tag_id');
    }
}