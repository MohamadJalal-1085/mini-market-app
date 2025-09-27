<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('products.index');
});

// Route for displaying the list of products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Route for showing the form to create a new product
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// Route for storing a new product
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// Route for displaying a single product
Route::get('/products/{product}/show', [ProductController::class, 'show'])->name('products.show');

// Route for showing the form to edit a product
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

// Route for updating a product
Route::put('/products/{product}/update', [ProductController::class, 'update'])->name('products.update');

// Route for deleting a product
Route::delete('/products/{product}/delete', [ProductController::class, 'destroy'])->name('products.destroy');