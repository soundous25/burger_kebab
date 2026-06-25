<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\OptionValueController;
use App\Http\Controllers\SupplementController;

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class)
    ->except(['show']);
Route::patch('categories/{category}/toggle', [CategoryController::class, 'toggle'])
    ->name('categories.toggle'); 
Route::patch('products/{product}/toggle', [ProductController::class, 'toggle'])
    ->name('products.toggle'); 
Route::resource('options', OptionController::class)->except(['show']);
Route::patch('options/{option}/toggle', [OptionController::class, 'toggle'])
    ->name('options.toggle');
// Valeurs d'options (nested sous options pour create/store)
Route::get('options/{option}/values/create', [OptionValueController::class, 'create'])
    ->name('option_values.create');
Route::post('options/{option}/values', [OptionValueController::class, 'store'])
    ->name('option_values.store');
Route::get('option-values/{optionValue}/edit', [OptionValueController::class, 'edit'])
    ->name('option_values.edit');
Route::put('option-values/{optionValue}', [OptionValueController::class, 'update'])
    ->name('option_values.update');
Route::delete('option-values/{optionValue}', [OptionValueController::class, 'destroy'])
    ->name('option_values.destroy');
Route::patch('option-values/{optionValue}/toggle', [OptionValueController::class, 'toggle'])
    ->name('option_values.toggle');        
Route::resource('supplements', SupplementController::class)->except(['show']);
Route::patch('supplements/{supplement}/toggle', [SupplementController::class, 'toggle'])
    ->name('supplements.toggle');    