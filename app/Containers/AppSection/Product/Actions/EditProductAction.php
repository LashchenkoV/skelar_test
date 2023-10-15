<?php

namespace App\Containers\AppSection\Product\Actions;

use App\Containers\AppSection\Product\Data\Repositories\ProductRepositoryInterface;
use App\Containers\AppSection\Product\Models\Product;
use App\Ship\Parents\Actions\Action;

class EditProductAction extends Action
{
    public function __construct(private readonly ProductRepositoryInterface $repository)
    {
    }

    public function run(array $data): Product
    {
        $id = $data['id'];
        unset($data['id']);

        return $this->repository->update($data, $id);
    }
}
