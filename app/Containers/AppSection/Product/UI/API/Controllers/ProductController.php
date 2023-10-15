<?php

namespace App\Containers\AppSection\Product\UI\API\Controllers;

use App\Containers\AppSection\Product\Actions\CreateProductAction;
use App\Containers\AppSection\Product\Actions\DeleteProductAction;
use App\Containers\AppSection\Product\Actions\EditProductAction;
use App\Containers\AppSection\Product\Actions\GetFilteredPaginatedProductsAction;
use App\Containers\AppSection\Product\UI\API\Requests\CreateProductRequest;
use App\Containers\AppSection\Product\UI\API\Requests\EditProductRequest;
use App\Containers\AppSection\Product\UI\API\Requests\GetFilteredProductsRequest;
use App\Containers\AppSection\Product\UI\API\Transformers\ProductTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class ProductController extends ApiController
{
    public function getFilteredProducts(GetFilteredProductsRequest $request): array
    {
        return $this->transform(
            data: app(GetFilteredPaginatedProductsAction::class)->run($request->validated()),
            transformerName: ProductTransformer::class
        );
    }

    public function createProduct(CreateProductRequest $request): array
    {
        $product = app(CreateProductAction::class)->run($request->validated());

        // Just JsonResources can be used also
        return $this->transform($product, ProductTransformer::class);
    }

    public function editProduct(EditProductRequest $request): array
    {
        $product = app(EditProductAction::class)->run($request->validated());

        return $this->transform($product, ProductTransformer::class);
    }

    public function deleteProduct(int $id): JsonResponse
    {
        return $this->json([
            'result' => app(DeleteProductAction::class)->run($id)
        ]);
    }
}
