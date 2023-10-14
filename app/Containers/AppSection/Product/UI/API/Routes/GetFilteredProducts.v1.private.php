<?php

use App\Containers\AppSection\Product\UI\API\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/products', [ProductController::class, 'getFilteredProducts'])
    ->middleware(['auth'])
    ->name('admin.product.get');
