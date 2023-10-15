<?php

namespace App\Containers\AppSection\Product\Providers;


use App\Containers\AppSection\Product\Data\Repositories\ProductRepository;
use App\Containers\AppSection\Product\Data\Repositories\ProductRepositoryInterface;

class MainServiceProvider extends \App\Ship\Parents\Providers\MainServiceProvider
{
    public function register(): void
    {
        parent::register();

        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }
}
