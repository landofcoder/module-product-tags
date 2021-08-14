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

namespace Lof\ProductTags\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;

class UpgradeData implements UpgradeDataInterface
{
    /**
	 * eavSetupFactory
	 *
	 * @var EavSetupFactory
	 */
	private $eavSetupFactory;

	/**
	 * @param EavSetupFactory $eavSetupFactory 
	 */
	public function __construct(
		EavSetupFactory $eavSetupFactory
		)
	{
		$this->eavSetupFactory = $eavSetupFactory;
	}
    /**
     * {@inheritdoc}
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        if (version_compare($context->getVersion(), "1.0.4", "<")) {
            //Your upgrade script
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
            $data = [
                'group' => 'General',
                'label' => 'Product Tags',
                'type' => 'text',
                'input' => 'text',
                'position' => 7,
                'visible' => true,
                'default' => '',
                'required' => false,
                'user_defined' => false,
                'visible_on_front' => true,
                'unique' => false,
                'backend' => 'Lof\ProductTags\Model\Product\Attribute\Backend\ProductTags',
                'is_global' => \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_STORE,
                'is_configurable' => true,
                'used_for_promo_rules' => true,
                'is_searchable' => false,
                'is_used_in_grid' => false,
                'is_comparable' => false,
                'is_filterable_in_grid' => false,
                'is_visible_on_front' => true,
                'used_for_sort_by' => false,
                'used_in_product_listing' => true
            ];
   
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'product_tags',
                $data);
        }
    }
}
