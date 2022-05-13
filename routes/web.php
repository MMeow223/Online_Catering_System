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
Route::get('/order-status/{id}', [\App\Http\Controllers\OrderStatusController::class,'show'])->name('orderView');

Route::resource('goods', \App\Http\Controllers\GoodsController::class);
Route::get('/view/goods/{id}', [\App\Http\Controllers\GoodsController::class, 'view']);

Route::resource('variety', \App\Http\Controllers\GoodVarietyController::class);
Route::resource('payments', \App\Http\Controllers\PaymentsController::class);
Route::resource('orders', \App\Http\Controllers\OrderController::class);
Route::resource('users', \App\Http\Controllers\UsersController::class);
Route::resource('cart', \App\Http\Controllers\ShoppingCartController::class);
Route::resource('voucher', \App\Http\Controllers\PromotionVoucherController::class);
Route::resource('customer', \App\Http\Controllers\CustomerController::class);
Route::resource('order-status', \App\Http\Controllers\OrderStatusController::class);

Route::get('/customer/true/{id}', [\App\Http\Controllers\CustomerController::class, 'true']);
Route::post('/customer/true/{id}/activateMember', [\App\Http\Controllers\CustomerController::class, 'activateMember'])->name('activateMember');
Route::get('/customer/false/{id}', [\App\Http\Controllers\CustomerController::class, 'false']);
Route::post('/customer/false/{id}/deactivateMember', [\App\Http\Controllers\CustomerController::class, 'deactivateMember'])->name('deactivateMember');
Route::get('/customer/member/{id}', [\App\Http\Controllers\CustomerController::class, 'member']);
Route::post('/customer/member/{id}/changeStatus', [\App\Http\Controllers\CustomerController::class, 'changeStatus'])->name('changeStatus');

Route::get('/cart/update/select/{item_id}',[\App\Http\Controllers\ShoppingCartController::class, 'updateSelected'])->name('cart.select');
Route::get('/cart/update/quantity/increase/{item_id}',[\App\Http\Controllers\ShoppingCartController::class, 'updateIncreaseQuantity']);
Route::get('/cart/update/quantity/decrease/{item_id}',[\App\Http\Controllers\ShoppingCartController::class, 'updateDecreaseQuantity']);
Route::get('/cart/update/cartItemPrice/{item_id}',[\App\Http\Controllers\ShoppingCartController::class, 'calculateCartItemPrice']);
Route::get('/cart/update/voucher/{voucher_code}',[\App\Http\Controllers\ShoppingCartController::class, 'updateSelectedVoucher']);
Route::get('/voucher/reset/{user_id}',[\App\Http\Controllers\ShoppingCartController::class, 'resetVoucher']);

Route::get('/checkout',[\App\Http\Controllers\ShoppingCartController::class, 'checkoutCartItem']);
Route::get('/placeOrder',[\App\Http\Controllers\OrderController::class, 'store']);
Route::get('/update/address',[\App\Http\Controllers\CustomerController::class, 'updateAddress']);

Route::get('/filterCategory/{category_id}', [\App\Http\Controllers\Controller::class, 'filterGoodBasedOnCategory'])->name('filterCategory');



