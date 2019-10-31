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
namespace Lof\ProductTags\Api;
use Magento\Framework\Api\SearchCriteriaInterface;
interface TagRepositoryInterface
{
    /**
     * Save Tag
     * @param \Lof\ProductTags\Api\Data\TagInterface $tag
     * @return \Lof\ProductTags\Api\Data\TagInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Lof\ProductTags\Api\Data\TagInterface $tag);
    /**
     * Retrieve Tag
     * @param string $tagId
     * @return \Lof\ProductTags\Api\Data\TagInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($tagId);
    /**
     * Retrieve Tag matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Lof\ProductTags\Api\Data\TagSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );
    /**
     * Delete Tag
     * @param bool $tagId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete($tagId);
    /**
     * Delete Tag by ID
     * @param string $tagId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($tagId);
    /**
     * Retrieve Tag
     * @param string $tagId
     * @return \Lof\ProductTags\Api\Data\TagInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getListTag($tagId);
}