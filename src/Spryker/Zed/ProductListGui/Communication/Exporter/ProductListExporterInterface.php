<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductListGui\Communication\Exporter;

use Generated\Shared\Transfer\ProductListTransfer;
use Symfony\Component\HttpFoundation\StreamedResponse;

interface ProductListExporterInterface
{
    public function exportToCsvFile(ProductListTransfer $productListTransfer): StreamedResponse;
}
