<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    $data = [
        'products' => \App\Models\Product::all(),
    ];
    return Inertia::render('StoreFront', $data);
})->name('home');

Route::get('/products/{product}', function (\App\Models\Product $product) {
    $data = ['product' => $product];
    return Inertia::render('store/ShowProduct', $data);
})->name('store.products.show');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
