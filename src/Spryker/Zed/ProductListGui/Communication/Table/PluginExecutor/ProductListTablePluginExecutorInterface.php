<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductListGui\Communication\Table\PluginExecutor;

use Generated\Shared\Transfer\QueryCriteriaTransfer;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

interface ProductListTablePluginExecutorInterface
{
    /**
     * @param array $item
     *
     * @return array<\Generated\Shared\Transfer\ButtonTransfer>
     */
    public function executeTableActionExpanderPlugins(array $item): array;

    public function executeTableConfigExpanderPlugins(TableConfiguration $config): TableConfiguration;

    public function executeTableQueryCriteriaExpanderPlugins(QueryCriteriaTransfer $queryCriteriaTransfer): QueryCriteriaTransfer;

    public function executeTableHeaderExpanderPlugins(): array;

    public function executeTableDataExpanderPlugins(array $item): array;
}
