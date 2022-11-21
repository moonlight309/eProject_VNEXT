<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\ProductController@list_product');
Route::get('/maker', 'App\Http\Controllers\MakerController@list_maker');
Route::get('/new', 'App\Http\Controllers\NewsController@list_new');
Route::get('/user', 'App\Http\Controllers\UserController@list_user');
Route::get('/category', 'App\Http\Controllers\CategoryController@list_category');
