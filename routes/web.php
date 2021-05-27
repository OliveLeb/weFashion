<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProductController;

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

// front routes
Route::get('/', [FrontController::class,'index'])->name('home');
Route::get('products/discount',[FrontController::class,'showDiscountedProducts'])->name('discount.products');
Route::get('product/{id}',[FrontController::class,'show'])->name('show.product');
Route::get('products/{id}',[FrontController::class,'showProductsByCategory'])->name('category.products');

Auth::routes();

// admin routes
Route::resource('admin/products',ProductController::class,['as'=>'admin'])->middleware('auth');
