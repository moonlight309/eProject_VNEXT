<?php

use App\Http\Controllers\MakerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.master');
})->name('home');

Route::group([
    'prefix' => 'makers',
    'as' => 'makers.',
], function () {
    Route::get('create', [MakerController::class, 'create'])->name('create');
    Route::post('store', [MakerController::class, 'store'])->name('store');
    Route::get('edit', [MakerController::class, 'edit'])->name('edit');
    Route::get('detail', [MakerController::class, 'detail'])->name('detail');
});

Route::prefix('product')->group(function () {
    //Route::get('products', [ProductController::class, 'index'])->name('product.home');
    Route::get('create', [ProductController::class, 'create'])->name('product.create');
    Route::post('store', [ProductController::class, 'store'])->name('product.store');
    Route::get('show/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::put('edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
    Route::get('detail/{id}', [ProductController::class, 'detail'])->name('product.detail');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
