<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MakerController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;



Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
//Route::group([
//    'prefix' => 'products',
//    'as' => 'categories.',
//]);




// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group([
    'prefix' => 'categories',
    'as'     => 'categories.',
], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');

    Route::get('create', [CategoryController::class, 'create'])->name('create');
    Route::post('store', [CategoryController::class, 'store'])->name('store');

    Route::post('detail/{id}', [CategoryController::class, 'show'])->name('detail');

    Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
    Route::put('update/{id}', [CategoryController::class, 'update'])->name('update');

    Route::delete('delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');
});

Route::group([
    'prefix' => 'makers',
    'as'     => 'makers.',
], function () {
    Route::get('/', [MakerController::class, 'index'])->name('index');
    Route::get('create', [MakerController::class, 'create'])->name('create');
    Route::post('store', [MakerController::class, 'store'])->name('store');
    Route::get('edit', [MakerController::class, 'edit'])->name('edit');
    Route::get('detail', [MakerController::class, 'detail'])->name('detail');
});

Route::group([
    'prefix' => 'products',
    'as' => 'products.',
],function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('store', [ProductController::class, 'store'])->name('store');
    Route::get('show/{id}', [ProductController::class, 'show'])->name('show');
    Route::put('edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
    Route::get('detail/{id}', [ProductController::class, 'detail'])->name('detail');
});

Route::group([
    'prefix' => 'news',
    'as' => 'news.',
],function () {
    Route::get('/', [NewsController::class, 'index'])->name('index');

});

Route::group([
    'prefix' => 'users',
    'as' => 'users.',
],function () {
    Route::get('/', [UserController::class, 'index'])->name('index');

});

require __DIR__ . '/auth.php';

