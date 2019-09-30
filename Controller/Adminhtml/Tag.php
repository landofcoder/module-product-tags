<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);
namespace Lof\ProductTags\Controller\Adminhtml;
use Magento\Store\Model\Store;
/**
 * Catalog Tag controller
 */
abstract class Tag extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Lof_ProductTags::Tag';
    /**
     * @var \Magento\Framework\Stdlib\DateTime\Filter\Date
     */
    protected $dateFilter;
    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\Filter\Date|null $dateFilter
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter = null
    ) {
        $this->dateFilter = $dateFilter;
        parent::__construct($context);
    }
    /**
     * Initialize requested category and put it into registry.
     * Root category can be returned, if inappropriate store/category is specified
     *
     * @return \Lof\ProductTags\Model\Tag|false
     */
    protected function _initTag()
    {
        $tagId = $this->resolveTagId();
        $storeId = $this->resolveStoreId();
        $tag = $this->_objectManager->create(\Lof\ProductTags\Model\Tag::class);
        if ($tagId) {
            $tag->load($tagId);
        }
        $this->_objectManager->get(\Magento\Framework\Registry::class)->register('tag', $tag);
        $this->_objectManager->get(\Magento\Framework\Registry::class)->register('current_tag', $tag);
        $this->_objectManager->get(\Magento\Cms\Model\Wysiwyg\Config::class)
            ->setStoreId($storeId);
        return $tag;
    }
    /**
     * Resolve Category Id (from get or from post)
     *
     * @return int
     */
    private function resolveTagId() : int
    {
        $tagId = (int)$this->getRequest()->getParam('tag_id', false);
        return $tagId ?: (int)$this->getRequest()->getParam('entity_id', false);
    }
    /**
     * Resolve store id
     *
     * Tries to take store id from store HTTP parameter
     * @see Store
     *
     * @return int
     */
    private function resolveStoreId() : int
    {
        $storeId = (int)$this->getRequest()->getParam('store', false);
        return $storeId ?: (int)$this->getRequest()->getParam('store_id', Store::DEFAULT_STORE_ID);
    }
}