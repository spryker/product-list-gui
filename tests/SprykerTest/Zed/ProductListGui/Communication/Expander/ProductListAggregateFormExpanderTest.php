<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerTest\Zed\ProductListGui\Communication\Expander;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ProductListAggregateFormTransfer;
use Generated\Shared\Transfer\ProductListProductConcreteRelationTransfer;
use Spryker\Zed\ProductListGui\Communication\Expander\ProductListAggregateFormExpander;
use Spryker\Zed\ProductListGui\Communication\Form\ProductListProductConcreteRelationFormType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Forms;

/**
 * Auto-generated group annotations
 *
 * @group SprykerTest
 * @group Zed
 * @group ProductListGui
 * @group Communication
 * @group Expander
 * @group ProductListAggregateFormExpanderTest
 * Add your own group annotations below this line
 */
class ProductListAggregateFormExpanderTest extends Unit
{
    protected const string ASSIGNED_PRODUCT_IDS = '1,2';

    protected const string PRODUCT_IDS_TO_BE_ASSIGNED = '3';

    protected const string PRODUCT_IDS_TO_BE_DEASSIGNED = '1';

    /**
     * @var \SprykerTest\Zed\ProductListGui\ProductListGuiCommunicationTester
     */
    protected $tester;

    public function testPostSubmitEventHandlerMergesProductIdsIntoProductConcreteRelationOnSubmit(): void
    {
        // Arrange
        $productListAggregateFormTransfer = (new ProductListAggregateFormTransfer())
            ->setProductListProductConcreteRelation(new ProductListProductConcreteRelationTransfer());
        $form = $this->createProductListAggregateForm($productListAggregateFormTransfer);

        // Act
        $form->submit([
            ProductListProductConcreteRelationFormType::FIELD_ASSIGNED_PRODUCT_IDS => static::ASSIGNED_PRODUCT_IDS,
            ProductListProductConcreteRelationFormType::FIELD_PRODUCT_IDS_TO_BE_ASSIGNED => static::PRODUCT_IDS_TO_BE_ASSIGNED,
            ProductListProductConcreteRelationFormType::FIELD_PRODUCT_IDS_TO_BE_DEASSIGNED => static::PRODUCT_IDS_TO_BE_DEASSIGNED,
        ]);

        // Assert
        $this->assertTrue($form->isSubmitted());
        $this->assertEqualsCanonicalizing(
            ['2', '3'],
            array_values($productListAggregateFormTransfer->getProductListProductConcreteRelationOrFail()->getProductIds()),
        );
    }

    protected function createProductListAggregateForm(ProductListAggregateFormTransfer $productListAggregateFormTransfer): FormInterface
    {
        $formBuilder = Forms::createFormFactory()->createBuilder(FormType::class, $productListAggregateFormTransfer, [
            'data_class' => ProductListAggregateFormTransfer::class,
        ]);

        $formBuilder
            ->add(ProductListAggregateFormTransfer::PRODUCT_LIST_PRODUCT_CONCRETE_RELATION, FormType::class, [
                'data_class' => ProductListProductConcreteRelationTransfer::class,
            ])
            ->add(ProductListProductConcreteRelationFormType::FIELD_ASSIGNED_PRODUCT_IDS, HiddenType::class)
            ->add(ProductListProductConcreteRelationFormType::FIELD_PRODUCT_IDS_TO_BE_ASSIGNED, HiddenType::class)
            ->add(ProductListProductConcreteRelationFormType::FIELD_PRODUCT_IDS_TO_BE_DEASSIGNED, HiddenType::class)
            ->addEventListener(FormEvents::POST_SUBMIT, [new ProductListAggregateFormExpander(), 'postSubmitEventHandler']);

        return $formBuilder->getForm();
    }
}
