<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductListGui;

use Orm\Zed\Product\Persistence\SpyProductQuery;
use Orm\Zed\ProductList\Persistence\SpyProductListQuery;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\ProductListGui\Dependency\Facade\ProductListGuiToCategoryFacadeBridge;
use Spryker\Zed\ProductListGui\Dependency\Facade\ProductListGuiToLocaleFacadeBridge;
use Spryker\Zed\ProductListGui\Dependency\Facade\ProductListGuiToProductFacadeBridge;
use Spryker\Zed\ProductListGui\Dependency\Facade\ProductListGuiToProductListFacadeBridge;
use Spryker\Zed\ProductListGui\Dependency\Service\ProductListGuiToUtilCsvServiceBridge;

/**
 * @method \Spryker\Zed\ProductListGui\ProductListGuiConfig getConfig()
 */
class ProductListGuiDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PROPEL_QUERY_PRODUCT = 'PROPEL_QUERY_PRODUCT';

    /**
     * @var string
     */
    public const PROPEL_QUERY_PRODUCT_LIST = 'PROPEL_QUERY_PRODUCT_LIST';

    /**
     * @var string
     */
    public const FACADE_PRODUCT_LIST = 'FACADE_PRODUCT_LIST';

    /**
     * @var string
     */
    public const FACADE_LOCALE = 'FACADE_LOCALE';

    /**
     * @var string
     */
    public const FACADE_CATEGORY = 'FACADE_CATEGORY';

    /**
     * @var string
     */
    public const FACADE_PRODUCT = 'FACADE_PRODUCT';

    /**
     * @var string
     */
    public const SERVICE_UTIL_CSV = 'SERVICE_UTIL_CSV';

    /**
     * @var string
     */
    public const PLUGINS_PRODUCT_LIST_TABLE_ACTION_EXPANDER = 'PLUGINS_PRODUCT_LIST_TABLE_ACTION_EXPANDER';

    /**
     * @var string
     */
    public const PLUGINS_PRODUCT_LIST_TABLE_CONFIG_EXPANDER = 'PLUGINS_PRODUCT_LIST_TABLE_CONFIG_EXPANDER';

    /**
     * @var string
     */
    public const PLUGINS_PRODUCT_LIST_TABLE_QUERY_CRITERIA_EXPANDER = 'PLUGINS_PRODUCT_LIST_TABLE_QUERY_CRITERIA_EXPANDER';

    /**
     * @var string
     */
    public const PLUGINS_PRODUCT_LIST_TABLE_DATA_EXPANDER = 'PLUGINS_PRODUCT_LIST_TABLE_DATA_EXPANDER';

    /**
     * @var string
     */
    public const PLUGINS_PRODUCT_LIST_TABLE_HEADER_EXPANDER = 'PLUGINS_PRODUCT_LIST_TABLE_DATA_EXPANDER';

    /**
     * @var string
     */
    public const PLUGINS_PRODUCT_LIST_TOP_BUTTONS_EXPANDER = 'PLUGINS_PRODUCT_LIST_TOP_BUTTONS_EXPANDER';

    /**
     * @var string
     */
    public const PLUGINS_PRODUCT_LIST_USED_BY_TABLE_EXPANDER = 'PLUGINS_PRODUCT_LIST_USED_BY_TABLE_EXPANDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container): Container
    {
        $container = parent::provideCommunicationLayerDependencies($container);

        $container = $this->addProductPropelQuery($container);
        $container = $this->addProductListPropelQuery($container);

        $container = $this->addProductListFacade($container);
        $container = $this->addLocaleFacade($container);
        $container = $this->addCategoryFacade($container);
        $container = $this->addProductFacade($container);

        $container = $this->addUtilCsvService($container);

        $container = $this->addProductListTableActionExpanderPlugins($container);
        $container = $this->addProductListTableConfigExpanderPlugins($container);
        $container = $this->addProductListTableQueryCriteriaExpanderPlugins($container);
        $container = $this->addProductListTableDataExpanderPlugins($container);
        $container = $this->addProductListTableHeaderExpanderPlugins($container);
        $container = $this->addProductListTopButtonsExpanderPlugins($container);
        $container = $this->addProductListUsedByTableExpanderPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListPropelQuery(Container $container): Container
    {
        $container->set(static::PROPEL_QUERY_PRODUCT_LIST, $container->factory(function () {
            return SpyProductListQuery::create();
        }));

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductPropelQuery(Container $container): Container
    {
        $container->set(static::PROPEL_QUERY_PRODUCT, $container->factory(function () {
            return SpyProductQuery::create();
        }));

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListFacade(Container $container): Container
    {
        $container->set(static::FACADE_PRODUCT_LIST, function ($container) {
            return new ProductListGuiToProductListFacadeBridge($container->getLocator()->productList()->facade());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCategoryFacade(Container $container): Container
    {
        $container->set(static::FACADE_CATEGORY, function ($container) {
            return new ProductListGuiToCategoryFacadeBridge($container->getLocator()->category()->facade());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductFacade(Container $container): Container
    {
        $container->set(static::FACADE_PRODUCT, function ($container) {
            return new ProductListGuiToProductFacadeBridge($container->getLocator()->product()->facade());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilCsvService(Container $container): Container
    {
        $container->set(static::SERVICE_UTIL_CSV, function (Container $container) {
            return new ProductListGuiToUtilCsvServiceBridge(
                $container->getLocator()->utilCsv()->service(),
            );
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addLocaleFacade(Container $container): Container
    {
        $container->set(static::FACADE_LOCALE, function ($container) {
            return new ProductListGuiToLocaleFacadeBridge($container->getLocator()->locale()->facade());
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListTableActionExpanderPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRODUCT_LIST_TABLE_ACTION_EXPANDER, function () {
            return $this->getProductListTableActionExpanderPlugins();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListTableConfigExpanderPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRODUCT_LIST_TABLE_CONFIG_EXPANDER, function () {
            return $this->getProductListTableConfigExpanderPlugins();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListTableQueryCriteriaExpanderPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRODUCT_LIST_TABLE_QUERY_CRITERIA_EXPANDER, function () {
            return $this->getProductListTableQueryCriteriaExpanderPlugins();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListTableDataExpanderPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRODUCT_LIST_TABLE_DATA_EXPANDER, function () {
            return $this->getProductListTableDataExpanderPlugins();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListTableHeaderExpanderPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRODUCT_LIST_TABLE_HEADER_EXPANDER, function () {
            return $this->getProductListTableHeaderExpanderPlugins();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListTopButtonsExpanderPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRODUCT_LIST_TOP_BUTTONS_EXPANDER, function () {
            return $this->getProductListTopButtonsExpanderPlugins();
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addProductListUsedByTableExpanderPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_PRODUCT_LIST_USED_BY_TABLE_EXPANDER, function () {
            return $this->getProductListUsedByTableExpanderPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Spryker\Zed\ProductListGuiExtension\Dependency\Plugin\ProductListTableActionExpanderPluginInterface>
     */
    protected function getProductListTableActionExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\Spryker\Zed\ProductListGuiExtension\Dependency\Plugin\ProductListTableConfigExpanderPluginInterface>
     */
    protected function getProductListTableConfigExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\Spryker\Zed\ProductListGuiExtension\Dependency\Plugin\ProductListTableQueryCriteriaExpanderPluginInterface>
     */
    protected function getProductListTableQueryCriteriaExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\Spryker\Zed\ProductListGuiExtension\Dependency\Plugin\ProductListTableDataExpanderPluginInterface>
     */
    protected function getProductListTableDataExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\Spryker\Zed\ProductListGuiExtension\Dependency\Plugin\ProductListTableDataExpanderPluginInterface>
     */
    protected function getProductListTableHeaderExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\Spryker\Zed\ProductListGuiExtension\Dependency\Plugin\ProductListTopButtonsExpanderPluginInterface>
     */
    protected function getProductListTopButtonsExpanderPlugins(): array
    {
        return [];
    }

    /**
     * @return array<\Spryker\Zed\ProductListGuiExtension\Dependency\Plugin\ProductListUsedByTableExpanderPluginInterface>
     */
    protected function getProductListUsedByTableExpanderPlugins(): array
    {
        return [];
    }
}
