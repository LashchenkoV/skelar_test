<?php

namespace App\Containers\AppSection\Product\Actions;

use App\Containers\AppSection\Product\Tasks\ProductsQueryBuilderTask;
use App\Ship\Parents\Actions\Action;

class GetFilteredPaginatedProductsAction extends Action
{
    public function run(array $filters = [])
    {
        return app(ProductsQueryBuilderTask::class)->run($filters)->paginate($filters['itemsPerPage']);
    }
}
