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

interface TagSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Tag list.
     * @return \Lof\ProductTags\Api\Data\TagInterface[]
     */
    public function getItems();

    /**
     * Set tag_name list.
     * @param \Lof\ProductTags\Api\Data\TagInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
