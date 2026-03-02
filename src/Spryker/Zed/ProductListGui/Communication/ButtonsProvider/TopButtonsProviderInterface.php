<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductListGui\Communication\ButtonsProvider;

use Generated\Shared\Transfer\ButtonCollectionTransfer;

interface TopButtonsProviderInterface
{
    public function getTopButtons(): ButtonCollectionTransfer;
}
