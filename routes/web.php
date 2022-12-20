<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MakerController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\LoadMore;
use App\Http\Livewire\LoadMoreHome;
use App\Http\Middleware\CheckAdminMiddleware;
use App\Http\Middleware\CheckLoginMiddleware;
use Illuminate\Support\Facades\Route;
//use App\Http\Livewire\Home;

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::group([
    'middleware' => [
        CheckLoginMiddleware::class,
        'verified',
    ]
], function () {
    Route::get('/', LoadMoreHome::class)->name('home');
    Route::get('/test', [TestController::class, 'index']);
    Route::get('/get-parent', [TestController::class, 'parent'])->name('parent');
    Route::get('/get-children', [TestController::class, 'children'])->name('children');

    Route::group([
        'prefix' => 'profile',
        'as' => 'profile.',
    ], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
    });

    Route::group([
        'prefix' => 'categories',
        'as' => 'categories.',
    ], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('create', [CategoryController::class, 'add'])->name('add');
        Route::get('create/{id}', [CategoryController::class, 'create'])->name('create');
        Route::post('store', [CategoryController::class, 'store'])->name('store');
        Route::get('detail/{id}', [CategoryController::class, 'show'])->name('detail');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    Route::group([
        'prefix' => 'makers',
        'as' => 'makers.',
    ], function () {
        Route::get('/', [MakerController::class, 'index'])->name('index');
        Route::get('create', [MakerController::class, 'create'])->name('create');
        Route::post('store', [MakerController::class, 'store'])->name('store');
        Route::get('detail/{id}', [MakerController::class, 'detail'])->name('detail');
        Route::get('edit/{id}', [MakerController::class, 'edit'])->name('edit');

        Route::post('update/{id}', [MakerController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [MakerController::class, 'destroy'])->name('destroy');

    });

    Route::group([
        'prefix' => 'products',
        'as' => 'products.',
    ], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('create', [ProductController::class, 'create'])->name('create');
        Route::post('store', [ProductController::class, 'store'])->name('store');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('edit');
        Route::put('update/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
        Route::get('show/{id}', [ProductController::class, 'show'])->name('show');

    });

    Route::group([
        'middleware' => CheckAdminMiddleware::class
    ], function () {
        Route::group([
            'prefix' => 'news',
            'as' => 'news.',
        ], function () {
            Route::get('/', [NewsController::class, 'index'])->name('index');
            Route::get('/create', [NewsController::class, 'create'])->name('create');
            Route::post('/store', [NewsController::class, 'store'])->name('store');
            Route::get('/detail/{id}', [NewsController::class, 'detail'])->name('detail');
            Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [NewsController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [NewsController::class, 'destroy'])->name('destroy');
        });

        Route::group([
            'prefix' => 'users',
            'as' => 'users.',
        ], function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/detail/{id}', [UserController::class, 'show'])->name('detail');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('destroy');
            Route::post('/import-csv', [UserController::class, 'importCsv'])->name('import_csv');
        });
    });
});

require __DIR__ . '/auth.php';
