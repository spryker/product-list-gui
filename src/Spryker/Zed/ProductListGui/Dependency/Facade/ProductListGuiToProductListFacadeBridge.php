<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductListGui\Dependency\Facade;

use Generated\Shared\Transfer\ProductListResponseTransfer;
use Generated\Shared\Transfer\ProductListTransfer;

class ProductListGuiToProductListFacadeBridge implements ProductListGuiToProductListFacadeInterface
{
    /**
     * @var \Spryker\Zed\ProductList\Business\ProductListFacadeInterface
     */
    protected $productListFacade;

    /**
     * @param \Spryker\Zed\ProductList\Business\ProductListFacadeInterface $productListFacade
     */
    public function __construct($productListFacade)
    {
        $this->productListFacade = $productListFacade;
    }

    public function getProductListById(ProductListTransfer $productListTransfer): ProductListTransfer
    {
        return $this->productListFacade->getProductListById($productListTransfer);
    }

    public function createProductList(ProductListTransfer $productListTransfer): ProductListResponseTransfer
    {
        return $this->productListFacade->createProductList($productListTransfer);
    }

    public function updateProductList(ProductListTransfer $productListTransfer): ProductListResponseTransfer
    {
        return $this->productListFacade->updateProductList($productListTransfer);
    }

    public function removeProductList(ProductListTransfer $productListTransfer): ProductListResponseTransfer
    {
        return $this->productListFacade->removeProductList($productListTransfer);
    }
}
