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

namespace Lof\ProductTags\Model\Data;

use Lof\ProductTags\Api\Data\TagInterface;

class Tag extends \Magento\Framework\Api\AbstractExtensibleObject implements TagInterface
{

    /**
     * Get tag_id
     * @return string|null
     */
    public function getTagId()
    {
        return $this->_get(self::TAG_ID);
    }

    /**
     * Set tag_id
     * @param string $tagId
     * @return $this
     */
    public function setTagId($tagId)
    {
        return $this->setData(self::TAG_ID, $tagId);
    }

    /**
     * Get tag_title
     * @return string|null
     */
    public function getTagTitle()
    {
        return $this->_get(self::TAG_TITLE);
    }

    /**
     * Set tag_title
     * @param string $tagTitle
     * @return \Lof\ProductTags\Api\Data\TagInterface
     */
    public function setTagTitle($tagTitle)
    {
        return $this->setData(self::TAG_TITLE, $tagTitle);
    }

    /**
     * Set status
     *
     * @return bool|null
     */
    public function getStatus(){
        return $this->_get(self::TAG_STATUS);
    }
    /**
     * Set status
     *
     * @param bool|null
     * @return $this
     */
    public function setStatus($status){
        return $this->setData(self::TAG_STATUS, $status);
    }

     /**
     * Set identifier
     *
     * @return string|null
     */
    public function getIdentifier(){
        return $this->_get(self::TAG_IDENTIFIER);
    }
    /**
     * Set identifier
     *
     * @param string|null
     * @return $this
     */
    public function setIdentifier($identifier){
        return $this->setData(self::TAG_IDENTIFIER, $identifier);
    }

    /**
     * Set tag_description
     *
     * @return string|null
     */
    public function getTagDescription(){
        return $this->_get(self::TAG_DESCRIPTION);
    }
    /**
     * Set tag_description
     *
     * @param string|null
     * @return $this
     */
    public function setTagDescription($tagDescription){
        return $this->setData(self::TAG_DESCRIPTION, $tagDescription);
    }

    /**
     * Set StoreId
     *
     * @return int|null
     */
    public function getStoreId(){
        return $this->_get("store_id");
    }
    /**
     * Set storeId
     *
     * @param int|null
     * @return $this
     */
    public function setStoreId($storeId){
        return $this->setData("store_id", $storeId);
    }

    /**
     * Set products
     *
     * @return string[]|null
     */
    public function getProducts(){
        return $this->_get("products");
    }
    /**
     * Set products
     *
     * @param string[]|null
     * @return $this
     */
    public function setProducts($products){
        return $this->setData("products", $products);
    }


}
