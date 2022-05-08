<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\Controller::class,'index'])->name('dashboard');
Route::get('/order-status', [\App\Http\Controllers\OrderStatusController::class,'index']);
// route resource for goods
Route::resource('goods', \App\Http\Controllers\GoodsController::class);

Route::get('/view/goods/{id}', [\App\Http\Controllers\GoodsController::class, 'view']);

Route::resource('variety', \App\Http\Controllers\GoodVarietyController::class);

Route::resource('payments', \App\Http\Controllers\PaymentsController::class);
Route::resource('orders', \App\Http\Controllers\OrderController::class);
Route::resource('users', \App\Http\Controllers\UsersController::class);
Route::resource('cart', \App\Http\Controllers\ShoppingCartController::class);

Route::get('/cart/update/select/{item_id}',[\App\Http\Controllers\ShoppingCartController::class, 'updateSelected'])->name('cart.select');
Route::get('/cart/update/quantity/increase/{item_id}',[\App\Http\Controllers\ShoppingCartController::class, 'updateIncreaseQuantity']);
Route::get('/cart/update/quantity/decrease/{item_id}',[\App\Http\Controllers\ShoppingCartController::class, 'updateDecreaseQuantity']);
Route::get('/cart/update/cartItemPrice/{item_id}',[\App\Http\Controllers\ShoppingCartController::class, 'calculateCartItemPrice']);

Route::get('/checkout',[\App\Http\Controllers\ShoppingCartController::class, 'checkoutCartItem']);


Route::get('/filterCategory/{category_id}', [\App\Http\Controllers\Controller::class, 'filterGoodBasedOnCategory'])->name('filterCategory');



