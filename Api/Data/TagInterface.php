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

namespace Lof\ProductTags\Api\Data;

interface TagInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const TAG_ID = 'tag_id';
    const TAG_NAME = 'tag_name';

    /**
     * Get tag_id
     * @return string|null
     */
    public function getTagId();

    /**
     * Set tag_id
     * @param string $tagId
     * @return \Lof\ProductTags\Api\Data\TagInterface
     */
    public function setTagId($tagId);

    /**
     * Get tag_name
     * @return string|null
     */
    public function getTagName();

    /**
     * Set tag_name
     * @param string $tagName
     * @return \Lof\ProductTags\Api\Data\TagInterface
     */
    public function setTagName($tagName);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Lof\ProductTags\Api\Data\TagExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Lof\ProductTags\Api\Data\TagExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Lof\ProductTags\Api\Data\TagExtensionInterface $extensionAttributes
    );
}
