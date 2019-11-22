<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Lof\ProductTags\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * @api
 * @since 100.0.2
 */
interface TagProductLinkInterface extends ExtensibleDataInterface
{
    const KEY_SKU = 'sku';
    const KEY_POSITION = 'position';
    const KEY_TAG_ID = 'tag_id';
    /**
     * @return string|null
     */
    public function getSku();

    /**
     * @param string $sku
     * @return $this
     */
    public function setSku($sku);

    /**
     * @return int|null
     */
    public function getPosition();

    /**
     * @param int $position
     * @return $this
     */
    public function setPosition($position);

    /**
     * Get tag id
     *
     * @return string
     */
    public function getTagId();

    /**
     * Set tag id
     *
     * @param string $tagId
     * @return $this
     */
    public function setTagId($tagId);

    /**
     * Retrieve existing extension attributes object.
     *
     * @return \Lof\ProductTags\Api\Data\TagProductLinkExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \Lof\ProductTags\Api\Data\TagProductLinkExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Lof\ProductTags\Api\Data\TagProductLinkExtensionInterface $extensionAttributes
    );
}
