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

use Lof\ProductTags\Api\Data\TagInterface;
use Lof\ProductTags\Api\Data\TagInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

class Tag extends \Magento\Framework\Model\AbstractModel
{

    protected $tagDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'lof_producttags_tag';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param TagInterfaceFactory $tagDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Lof\ProductTags\Model\ResourceModel\Tag $resource
     * @param \Lof\ProductTags\Model\ResourceModel\Tag\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        TagInterfaceFactory $tagDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Lof\ProductTags\Model\ResourceModel\Tag $resource,
        \Lof\ProductTags\Model\ResourceModel\Tag\Collection $resourceCollection,
        array $data = []
    ) {
        $this->tagDataFactory = $tagDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve tag model with tag data
     * @return TagInterface
     */
    public function getDataModel()
    {
        $tagData = $this->getData();
        
        $tagDataObject = $this->tagDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $tagDataObject,
            $tagData,
            TagInterface::class
        );
        
        return $tagDataObject;
    }
}
