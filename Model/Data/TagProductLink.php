<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Lof\ProductTags\Model\Data;

/**
 * @codeCoverageIgnore
 */
class TagProductLink extends \Magento\Framework\Api\AbstractExtensibleObject implements
    \Lof\ProductTags\Api\Data\TagProductLinkInterface
{
    /**#@+
     * Constant for confirmation status
     */
    
    /**#@-*/

    /**
     * {@inheritdoc}
     */
    public function getSku()
    {
        return $this->_get(self::KEY_SKU);
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition()
    {
        return $this->_get(self::KEY_POSITION);
    }

    /**
     * {@inheritdoc}
     */
    public function getTagId()
    {
        return $this->_get(self::KEY_TAG_ID);
    }

    /**
     * @param string $sku
     * @return $this
     */
    public function setSku($sku)
    {
        return $this->setData(self::KEY_SKU, $sku);
    }

    /**
     * @param int $position
     * @return $this
     */
    public function setPosition($position)
    {
        return $this->setData(self::KEY_POSITION, $position);
    }

    /**
     * Set category id
     *
     * @param string $tagId
     * @return $this
     */
    public function setTagId($tagId)
    {
        return $this->setData(self::KEY_TAG_ID, $tagId);
    }

    /**
     * {@inheritdoc}
     *
     * @return \Lof\ProductTags\Api\Data\TagProductLinkExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * {@inheritdoc}
     *
     * @param \Lof\ProductTags\Api\Data\TagProductLinkExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Lof\ProductTags\Api\Data\TagProductLinkExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
