<?php
/**
 * Landofcoder
 * 
 * NOTICE OF LICENSE
 * 
 * This source file is subject to the Landofcoder.com license that is
 * available through the world-wide-web at this URL:
 * http://landofcoder.com/license
 * 
 * DISCLAIMER
 * 
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 * 
 * @category   Landofcoder
 * @package    Lof_ProductTags
 * @copyright  Copyright (c) 2019 Landofcoder (http://www.landofcoder.com/)
 * @license    http://www.landofcoder.com/LICENSE-1.0.html
 */
namespace Lof\ProductTags\Model;
use Lof\ProductTags\Api\Data\TagInterface;
use Lof\ProductTags\Api\Data\TagInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
class Tag extends \Magento\Framework\Model\AbstractModel
{
    protected $tagDataFactory;
    protected $dataObjectHelper;
    protected $_eventPrefix = 'lof_producttags_tag';
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        TagInterfaceFactory $tagDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Lof\ProductTags\Model\ResourceModel\Tag $resource,
        \Lof\ProductTags\Model\ResourceModel\Tag\Collection $resourceCollection,
        array $data = []
    ) {
        $this->tagDataFactory = $tagDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

   
    public function getDataModel()
    {
        $tagData = $this->getData();
        
        $tagDataObject = $this->tagDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $tagDataObject,
            $tagData,
            TagInterface::class
        );
        
        return $tagDataObject;
    }

    /**
     * Retrieve array of product id's for category
     *
     * The array returned has the following format:
     * array($productId => $position)
     *
     * @return array
     */
    public function getProductsPosition()
    {
        if (!$this->getId()) {
            return [];
        }

        $array = $this->getData('products_position');
        if ($array === null) {
            $array = $this->getResource()->getProductsPosition($this);
            $this->setData('products_position', $array);
        }
        return $array;
    }

    public function loadByIdentifier($tag_code){
        if($tag_code){
            $tag_id = $this->getResource()->getTagIdByIdentifier($tag_code);
            if($tag_id) {
                $this->load((int)$tag_id);
                return $this;
            }
        }
        return false;
    }

    public function getRelatedReadonly(){
        return true;
    }
   
}
