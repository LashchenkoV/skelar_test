<?php

namespace App\Containers\AppSection\Product\Actions;

use App\Containers\AppSection\Product\Data\Repositories\ProductRepositoryInterface;
use App\Ship\Parents\Actions\Action;

class DeleteProductAction extends Action
{
    public function __construct(private readonly ProductRepositoryInterface $repository)
    {
    }

    public function run(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
