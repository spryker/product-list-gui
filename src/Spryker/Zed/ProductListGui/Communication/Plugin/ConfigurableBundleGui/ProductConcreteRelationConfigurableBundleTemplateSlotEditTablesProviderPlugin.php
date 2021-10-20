<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductListGui\Communication\Plugin\ConfigurableBundleGui;

use Spryker\Zed\ConfigurableBundleGuiExtension\Dependency\Plugin\ConfigurableBundleTemplateSlotEditTablesProviderPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Spryker\Zed\ProductListGui\ProductListGuiConfig getConfig()
 * @method \Spryker\Zed\ProductListGui\Communication\ProductListGuiCommunicationFactory getFactory()
 */
class ProductConcreteRelationConfigurableBundleTemplateSlotEditTablesProviderPlugin extends AbstractPlugin implements ConfigurableBundleTemplateSlotEditTablesProviderPluginInterface
{
    /**
     * @var string
     */
    protected const AVAILABLE_PRODUCT_CONCRETE_TABLE_NAME = 'availableProductConcreteTable';

    /**
     * @var string
     */
    protected const ASSIGNED_PRODUCT_CONCRETE_TABLE_NAME = 'assignedProductConcreteTable';

    /**
     * {@inheritDoc}
     * - Provides tables for Assign Products tab.
     *
     * @api
     *
     * @return array<\Spryker\Zed\Gui\Communication\Table\AbstractTable>
     */
    public function provideTables(): array
    {
        return [
            static::AVAILABLE_PRODUCT_CONCRETE_TABLE_NAME => $this->getFactory()->createAvailableProductConcreteTable(),
            static::ASSIGNED_PRODUCT_CONCRETE_TABLE_NAME => $this->getFactory()->createAssignedProductConcreteTable(),
        ];
    }
}
