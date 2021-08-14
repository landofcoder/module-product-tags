<?php
/**
 * Landofcoder
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Landofcoder.com license that is
 * available through the world-wide-web at this URL:
 * https://landofcoder.com/terms
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category   Landofcoder
 * @package    Lof_ProductTags
 * @copyright  Copyright (c) 2021 Landofcoder (https://www.landofcoder.com/)
 * @license    https://landofcoder.com/terms
 */

namespace Lof\ProductTags\Model\Product\Attribute\Backend;

use Magento\Framework\Exception\LocalizedException;

class ProductTags extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
    /**
     * @var \Magento\Framework\Locale\FormatInterface
     */
    protected $_localeFormat;

    public function __construct(
        \Magento\Framework\Locale\FormatInterface $localeFormat
    ) {
        $this->_localeFormat = $localeFormat;
    }

    /**
     * Validate object
     *
     * @param \Magento\Framework\DataObject $object
     * @return bool
     * @throws LocalizedException
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function validate($object)
    {
        parent::validate($object);
        $attrCode = $this->getAttribute()->getAttributeCode();
        $value = $object->getData($attrCode);

        $optionCount = 0;
    }

    /**
     * Sort values
     *
     * @param array $data
     * @return array
     */
    protected function _sortValues($data)
    {
        usort($data, [$this, '_sortStoreCreditPrices']);
        return $data;
    }

    /**
     * Sort tier price values callback method
     *
     * @param array $a
     * @param array $b
     * @return int
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    protected function _sortStoreCreditPrices($a, $b)
    {
        if ($a['credit_value'] != $b['credit_value']) {
            return $a['credit_value'] < $b['credit_value'] ? -1 : 1;
        }

        return 0;
    }

    /**
     * Before save method
     *
     * @param \Magento\Framework\DataObject $object
     * @return $this
     */
    public function beforeSave($object)
    {
        $attrCode = $this->getAttribute()->getAttributeCode();

        $value = $object->getData($attrCode);

        if ($value && is_array($value)) {
            $value = array_values($value);
            $value = json_encode($value);
            $object->setData($attrCode, $value);
        }

        return parent::beforeSave($object);
    }

    /**
     * After load method
     *
     * @param \Magento\Framework\DataObject $object
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @codeCoverageIgnore
     */
    public function afterLoad($object)
    {
        $attrCode = $this->getAttribute()->getAttributeCode();
        $value = $object->getData($attrCode);

        if ($value) {
            if (!is_array($value)) {
                $value = json_decode($value, true);
            }
            if ($value === null || !is_array($value)) {
                $value = [];
            }

            $object->setData($attrCode, $value);
        }

        return $this;
    }
}
