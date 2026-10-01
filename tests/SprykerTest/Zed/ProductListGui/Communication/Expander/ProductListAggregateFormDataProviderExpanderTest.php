<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\ProductListGui\Communication\Expander;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ProductListAggregateFormTransfer;
use Generated\Shared\Transfer\ProductListCategoryRelationTransfer;
use Generated\Shared\Transfer\ProductListProductConcreteRelationTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\ProductListGui\Communication\Expander\ProductListAggregateFormDataProviderExpander;
use Spryker\Zed\ProductListGui\Communication\Form\DataProvider\ProductListCategoryRelationFormDataProvider;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group ProductListGui
 * @group Communication
 * @group Expander
 * @group ProductListAggregateFormDataProviderExpanderTest
 * Add your own group annotations below this line
 */
class ProductListAggregateFormDataProviderExpanderTest extends Unit
{
    protected const int ID_PRODUCT_LIST = 6;

    protected const array CATEGORY_IDS = [2, 5];

    protected const array PRODUCT_IDS = [325, 326];

    /**
     * @var \SprykerTest\Zed\ProductListGui\ProductListGuiCommunicationTester
     */
    protected $tester;

    public function testExpandProductListAggregateFormDataReusesCategoryRelationOfLoadedProductList(): void
    {
        // Arrange
        $productListTransfer = (new ProductListTransfer())
            ->setIdProductList(static::ID_PRODUCT_LIST)
            ->setProductListCategoryRelation((new ProductListCategoryRelationTransfer())->setCategoryIds(static::CATEGORY_IDS))
            ->setProductListProductConcreteRelation((new ProductListProductConcreteRelationTransfer())->setProductIds(static::PRODUCT_IDS));
        $productListCategoryRelationFormDataProviderMock = $this->createMock(ProductListCategoryRelationFormDataProvider::class);

        // Act
        $productListAggregateFormTransfer = (new ProductListAggregateFormDataProviderExpander($productListCategoryRelationFormDataProviderMock))
            ->expandProductListAggregateFormData((new ProductListAggregateFormTransfer())->setProductList($productListTransfer));

        // Assert
        $productListCategoryRelationTransfer = $productListAggregateFormTransfer->getProductListCategoryRelationOrFail();
        $this->assertSame($productListTransfer->getProductListCategoryRelation(), $productListCategoryRelationTransfer);
        $this->assertSame(static::ID_PRODUCT_LIST, $productListCategoryRelationTransfer->getIdProductList());
        $this->assertSame(static::CATEGORY_IDS, $productListCategoryRelationTransfer->getCategoryIds());
        $this->assertSame(implode(',', static::PRODUCT_IDS), $productListAggregateFormTransfer->getAssignedProductIds());
    }

    public function testExpandProductListAggregateFormDataSetsEmptyCategoryRelationForNewProductList(): void
    {
        // Arrange
        $productListCategoryRelationFormDataProviderMock = $this->createMock(ProductListCategoryRelationFormDataProvider::class);

        // Act
        $productListAggregateFormTransfer = (new ProductListAggregateFormDataProviderExpander($productListCategoryRelationFormDataProviderMock))
            ->expandProductListAggregateFormData((new ProductListAggregateFormTransfer())->setProductList(new ProductListTransfer()));

        // Assert
        $productListCategoryRelationTransfer = $productListAggregateFormTransfer->getProductListCategoryRelationOrFail();
        $this->assertNull($productListCategoryRelationTransfer->getIdProductList());
        $this->assertSame([], $productListCategoryRelationTransfer->getCategoryIds());
    }
}
