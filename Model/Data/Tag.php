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
        return $this->_get(self::STORE_ID);
    }
    /**
     * Set storeId
     *
     * @param int|null
     * @return $this
     */
    public function setStoreId($storeId){
        return $this->setData(self::STORE_ID, $storeId);
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