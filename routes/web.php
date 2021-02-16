<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsConttroller;
use App\Http\Controllers\UsersConttroller;
use App\Http\Controllers\HomeConttroller;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('name');

Route::get('back', [App\Http\Controllers\HomeController::class, 'index'])->name('name');

Route::get('/products', [App\Http\Controllers\ProductsController::class, 'index']);

Route::get('/products/search/{string}', [App\Http\Controllers\ProductsController::class, 'search']);

Route::get('/products/{id}', [App\Http\Controllers\ProductsController::class, 'show'])->where(['id' => '[0-9]+']);

Route::get('/products/add', [App\Http\Controllers\ProductsController::class, 'add']);

Route::post('/products', [App\Http\Controllers\ProductsController::class, 'store']);

Route::get('/products/{id}/edit', [App\Http\Controllers\ProductsController::class, 'edit'])->where(['id' => '[0-9]+']);;

Route::post('/products/{id}/update', [App\Http\Controllers\ProductsController::class, 'update'])->where(['id' => '[0-9]+']);;

Route::delete('/products/{id}/delete', [App\Http\Controllers\ProductsController::class, 'destroy'])->where(['id' => '[0-9]+']);;

Route::get('/users', [App\Http\Controllers\UsersController::class, 'index']);

Route::get('/users/{id}', [App\Http\Controllers\UsersController::class, 'show'])->where(['id' => '[0-9]+']);;

Route::post('/users/{id}/update', [App\Http\Controllers\UsersController::class, 'update'])->where(['id' => '[0-9]+']);;

Route::get('/users/{id}/products', [App\Http\Controllers\UsersController::class, 'products'])->where(['id' => '[0-9]+']);;

Route::post('/users/{id}/admin', [App\Http\Controllers\UsersController::class, 'changeAdmin'])->where(['id' => '[0-9]+']);;

Route::delete('/users/{id}/delete', [App\Http\Controllers\UsersController::class, 'destroy'])->where(['id' => '[0-9]+']);;

Route::get('/change-password', [App\Http\Controllers\Auth\ChangePasswordController::class, 'index']);

Route::post('/change-password', [App\Http\Controllers\Auth\ChangePasswordController::class, 'store']);

