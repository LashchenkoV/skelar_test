<?php

use App\Containers\AppSection\Product\UI\API\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::put('/admin/products', [ProductController::class, 'editProduct'])
    ->middleware(['auth:sanctum'])
    ->name('admin.product.edit');
