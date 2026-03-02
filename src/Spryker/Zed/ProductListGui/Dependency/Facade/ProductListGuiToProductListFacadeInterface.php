<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductListGui\Dependency\Facade;

use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

interface ProductListGuiToProductListFacadeInterface
{
    public function createProductList(ProductListTransfer $productListTransfer): ProductListResponseTransfer;

    public function updateProductList(ProductListTransfer $productListTransfer): ProductListResponseTransfer;

    public function getProductListById(ProductListTransfer $productListTransfer): ProductListTransfer;

    public function removeProductList(ProductListTransfer $productListTransfer): ProductListResponseTransfer;
}
