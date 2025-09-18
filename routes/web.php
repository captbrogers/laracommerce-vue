<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    $data = [
        'products' => \App\Models\Product::all(),
    ];
    return Inertia::render('StoreFront', $data);
})->name('home');

Route::get('/products/{product}', function (\App\Models\Product $product) {
    $data = [
        'product' => $product,
    ];
    return Inertia::render('store/ShowProduct', $data);
})->name('store.products.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::controller(ProductController::class)->group(function () {
            Route::get('/products', 'index')->name('products.productIndex');
            Route::get('/products/create', 'create')->name('products.productCreate');
            Route::post('/products', 'store')->name('products.productStore');
            Route::get('/products/{product}', 'show')->where('product', '[0-9]+')->name('products.productShow');
            Route::get('/products/{product}/edit', 'edit')->where('product', '[0-9]+')->name('products.productEdit');
            Route::post('/products/{product}', 'update')->where('product', '[0-9]+')->name('products.productUpdate');
            Route::delete('/products/{product}', 'destroy')->where('product', '[0-9]+')->name('products.productDestroy');
        });
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
