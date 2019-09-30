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

namespace Lof\ProductTags\Model;

use Lof\ProductTags\Api\TagsManagementInterface;
use Lof\ProductTags\Api\Data\TagSearchResultsInterfaceFactory;
use Lof\ProductTags\Api\Data\TagInterfaceFactory;
use Lof\ProductTags\Model\ResourceModel\Tag as ResourceTag;
use Lof\ProductTags\Model\ResourceModel\Tag\CollectionFactory as TagCollectionFactory;

class ProductsManagement implements \Lof\ProductTags\Api\ProductsManagementInterface
{
    protected $resource;

    protected $tagFactory;

    protected $tagCollectionFactory;

    protected $searchResultsFactory;

    protected $dataTagFactory;

    /**
     * @var \Lof\ProductTags\Api\Data\TagProductLinkInterfaceFactory
     */
    protected $productLinkFactory;

    /**
     * @param ResourceTag $resource
     * @param TagFactory $tagFactory
     * @param TagInterfaceFactory $dataTagFactory
     * @param TagCollectionFactory $tagCollectionFactory
     * @param \Lof\ProductTags\Model\TagFactory $tagModelFactory
     * @param TagSearchResultsInterfaceFactory $searchResultsFactory
     * @param \Lof\ProductTags\Api\Data\TagProductLinkInterfaceFactory $productLinkFactory
     */

    public function __construct(
        ResourceTag $resource,
        TagFactory $tagFactory,
        TagInterfaceFactory $dataTagFactory,
        TagCollectionFactory $tagCollectionFactory,
        \Lof\ProductTags\Model\TagFactory $tagModelFactory,
        TagSearchResultsInterfaceFactory $searchResultsFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\Product\Visibility $catalogProductVisibility,
        \Lof\ProductTags\Api\Data\TagProductLinkInterfaceFactory $productLinkFactory
    ) {
        $this->resource = $resource;
        $this->tagFactory = $tagFactory;
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_catalogProductVisibility = $catalogProductVisibility;
        $this->tagCollectionFactory = $tagCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataTagFactory = $dataTagFactory;
        $this->_tagModelFactory = $tagModelFactory;
        $this->productLinkFactory = $productLinkFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getProducts($tagCode)
    {
        $tagModel = $this->_tagModelFactory->create();
        $tagModel->loadByIdentifier($tagCode);
        if (!$tagModel->getId()) {
            return [];
        }
        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $products */
        $products = $tagModel->getProductCollection();
        /** @var \Lof\ProductTags\Api\Data\TagProductLinkInterface[] $links */
        $links = [];
        if($products){
            /** @var \Magento\Catalog\Model\Product $product */
            foreach ($products->getItems() as $product) {
                /** @var \Lof\ProductTags\Api\Data\TagProductLinkInterface $link */
                $link = $this->productLinkFactory->create();
                $link->setSku($product->getSku())
                    ->setPosition($product->getData('tag_index_position'))
                    ->setTagId($tagModel->getId());
                $links[] = $link;
            }
        }
        if($links){
            return $links;
        }
        return false;
    }
}
