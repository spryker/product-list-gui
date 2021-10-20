<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductListGui\Communication\Controller;

use Spryker\Service\UtilText\Model\Url\Url;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Spryker\Zed\ProductListGui\Communication\ProductListGuiCommunicationFactory getFactory()
 */
class CreateController extends ProductListAbstractController
{
    /**
     * @var string
     */
    public const MESSAGE_PRODUCT_LIST_CREATE_SUCCESS = 'Product List "%s" has been successfully created.';

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|array
     */
    public function indexAction(Request $request)
    {
        $productListAggregateForm = $this->createProductListAggregateForm($request);
        $productListTransfer = $this->findProductListTransfer(
            $request,
            $productListAggregateForm,
        );

        $viewData = $this->prepareTemplateVariables($productListAggregateForm);
        $viewData['productListAggregationTabs'] = $this->getFactory()
            ->createProductListCreateAggregationTabs()
            ->createView();

        if ($productListTransfer === null) {
            return $this->viewResponse($viewData);
        }

        $productListResponseTransfer = $this->getFactory()
            ->getProductListFacade()
            ->createProductList($productListTransfer);

        $this->addMessagesFromProductListResponseTransfer($productListResponseTransfer);

        if ($productListResponseTransfer->getIsSuccessful()) {
            $this->addSuccessMessage(static::MESSAGE_PRODUCT_LIST_CREATE_SUCCESS, [
                '%s' => $productListTransfer->getTitle(),
            ]);

            return $this->redirectResponse($this->getEditUrl($productListResponseTransfer->getProductList()->getIdProductList()));
        }

        $viewData = $this->prepareTemplateVariables($productListAggregateForm);
        $viewData['productListAggregationTabs'] = $this->getFactory()
            ->createProductListCreateAggregationTabs()
            ->createView();

        return $this->viewResponse();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function availableProductConcreteTableAction(): JsonResponse
    {
        $availableProductConcreteTable = $this->getFactory()->createAvailableProductConcreteTable();

        return $this->jsonResponse(
            $availableProductConcreteTable->fetchData(),
        );
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function assignedProductConcreteTableAction(): JsonResponse
    {
        $assignedProductConcreteTable = $this->getFactory()->createAssignedProductConcreteTable();

        return $this->jsonResponse(
            $assignedProductConcreteTable->fetchData(),
        );
    }

    /**
     * @param int $idProductList
     *
     * @return string
     */
    protected function getEditUrl(int $idProductList): string
    {
        $query = [
            static::URL_PARAM_ID_PRODUCT_LIST => $idProductList,
        ];

        return Url::generate(RoutingConstants::URL_EDIT, $query, [])->build();
    }
}
