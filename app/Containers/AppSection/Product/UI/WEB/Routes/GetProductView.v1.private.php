<?php

use App\Containers\AppSection\Product\UI\WEB\Controllers\ProductViewController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/products', [ProductViewController::class, 'getProductsView'])
    ->middleware(['auth'])
    ->name('admin.product.view');
