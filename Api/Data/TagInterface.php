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
namespace Lof\ProductTags\Api\Data;

interface TagInterface
{

    const TAG_ID = 'tag_id';
    const TAG_TITLE = 'tag_title';
    const TAG_IDENTIFIER = 'identifier';
    const TAG_DESCRIPTION = 'tag_description';
    const TAG_STATUS = 'status';
    const STORE_ID = 'store_id';
    /**
     * Get tagID
     *
     * @return int|null
     */
    public function getTagId();
    /**
     * Set tagID
     *
     * @param int|null
     * @return $this
     */
    public function setTagId($tagId);
    /**
     * Set tagTitle
     *
     * @return string|null
     */
    public function getTagTitle();
    /**
     * Set tagTitle
     *
     * @param string|null
     * @return $this
     */
    public function setTagTitle($tagTitle);
    /**
     * Set status
     *
     * @return bool|null
     */
    public function getStatus();
    /**
     * Set status
     *
     * @param bool|null
     * @return $this
     */
    public function setStatus($status);

    /**
     * Set identifier
     *
     * @return string|null
     */
    public function getIdentifier();
    /**
     * Set identifier
     *
     * @param string|null
     * @return $this
     */
    public function setIdentifier($identifier);

    /**
     * Set tag_description
     *
     * @return string|null
     */
    public function getTagDescription();
    /**
     * Set tag_description
     *
     * @param string|null
     * @return $this
     */
    public function setTagDescription($tagDescription);

    /**
     * Set StoreId
     *
     * @return int|null
     */
    public function getStoreId();
    /**
     * Set storeId
     *
     * @param int|null
     * @return $this
     */
    public function setStoreId($storeId);

    /**
     * Set products
     *
     * @return string[]|null
     */
    public function getProducts();
    /**
     * Set products
     *
     * @param string[]|null
     * @return $this
     */
    public function setProducts($products);


    
}
