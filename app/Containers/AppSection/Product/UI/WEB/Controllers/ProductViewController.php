<?php

namespace App\Containers\AppSection\Product\UI\WEB\Controllers;

use App\Ship\Parents\Controllers\WebController;
use Inertia\Inertia;
use Inertia\Response;

class ProductViewController extends WebController
{
    public function getProductsView(): Response
    {
        return Inertia::render('Admin/Product/Main');
    }
}
