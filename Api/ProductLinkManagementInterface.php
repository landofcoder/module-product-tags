<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Lof\ProductTags\Api;

/**
 * @api
 * @since 100.0.2
 */
interface ProductLinkManagementInterface
{
    /**
     * Get products assigned to category
     *
     * @param int $productSku
     * @return \Lof\ProductTags\Api\Data\ProductTagLinkInterface[]
     */
    public function getAssignedProducts($categoryId);

    /**
     * Assign product to given categories
     *
     * @param string $tagId
     * @param int[] $productSku
     * @return bool
     * @since 101.0.0
     */
    public function assignProductToCategories($productSku, $tagId);
}
