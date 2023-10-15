<?php

namespace App\Containers\AppSection\Product\Tasks;

use App\Containers\AppSection\Product\Models\Product;
use App\Ship\Parents\Tasks\QueryBuilderTask;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ProductsQueryBuilderTask extends QueryBuilderTask
{
    protected function handleSortBy(array $filters): void
    {
        foreach ($filters as $filter) {
            $this->query->orderBy($filter['key'], $filter['order']);
        }
    }

    protected function handleName(string $name): void
    {
        $this->query->where('name', 'like', "%{$name}%");
    }

    protected function handleQuantity(int $quantity): void
    {
        $this->query->where('quantity', '>', $quantity);
    }

    protected function buildBaseQuery(): Builder
    {
        return Product::query();
    }
}
