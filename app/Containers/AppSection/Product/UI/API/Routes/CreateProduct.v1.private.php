<?php

use App\Containers\AppSection\Product\UI\API\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/admin/products', [ProductController::class, 'createProduct'])
    ->middleware(['auth:sanctum'])
    ->name('admin.product.create');
