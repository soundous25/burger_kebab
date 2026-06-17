<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::patch('categories/{category}/toggle', [CategoryController::class, 'toggle'])
    ->name('categories.toggle'); 
Route::patch('products/{product}/toggle', [ProductController::class, 'toggle'])
    ->name('products.toggle'); 