<?php

namespace App\Containers\AppSection\Product\Data\Repositories;

use App\Containers\AppSection\Product\Models\Product;
use App\Ship\Parents\Repositories\Repository;

class ProductRepository extends Repository implements ProductRepositoryInterface
{
    public function model(): string
    {
        return Product::class;
    }
}
