<?php

namespace App\Containers\AppSection\Product\UI\API\Controllers;

use App\Containers\AppSection\Product\Actions\GetFilteredPaginatedProductsAction;
use App\Containers\AppSection\Product\UI\API\Requests\GetFilteredProductsRequest;
use App\Containers\AppSection\Product\UI\API\Transformers\ProductTransformer;
use App\Ship\Parents\Controllers\ApiController;

class ProductController extends ApiController
{
    public function getFilteredProducts(GetFilteredProductsRequest $request): array
    {
        return $this->transform(
            data: app(GetFilteredPaginatedProductsAction::class)->run($request->validated()),
            transformerName: ProductTransformer::class
        );
    }
}
