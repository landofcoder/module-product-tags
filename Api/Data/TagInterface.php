<?php
namespace Lof\ProductTags\Api\Data;

interface TagInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const TAG_ID = 'tag_id';
    const TAG_NAME = 'tag_name';
    public function getTagId();

    public function setTagId($tagId);
    public function getTagName();
    public function setTagName($tagName);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Lof\ProductTags\Api\Data\TagExtensionInterface|null
     */
    // public function getExtensionAttributes();

    // /**
    //  * Set an extension attributes object.
    //  * @param \Lof\ProductTags\Api\Data\TagExtensionInterface $extensionAttributes
    //  * @return $this
    //  */
    // public function setExtensionAttributes(
    //     \Lof\ProductTags\Api\Data\TagExtensionInterface $extensionAttributes
    // );
}
