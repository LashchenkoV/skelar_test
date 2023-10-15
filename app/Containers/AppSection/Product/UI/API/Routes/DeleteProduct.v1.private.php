<?php

use App\Containers\AppSection\Product\UI\API\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::delete('/admin/products/{id}', [ProductController::class, 'deleteProduct'])
    ->where('id', '^[1-9][0-9]*$')
    ->middleware(['auth:sanctum'])
    ->name('admin.product.delete');
