<?php

namespace App\Containers\AppSection\Product\Actions;

use App\Containers\AppSection\Product\Data\Repositories\ProductRepositoryInterface;
use App\Containers\AppSection\Product\Models\Product;
use App\Ship\Parents\Actions\Action;

class CreateProductAction extends Action
{
    public function __construct(private readonly ProductRepositoryInterface $repository)
    {
    }

    public function run(array $data): Product
    {
        // Fill and create a new model
        return $this->repository->create($data);
    }
}
