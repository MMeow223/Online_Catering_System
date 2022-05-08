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
// route resource for goods
Route::resource('goods', \App\Http\Controllers\GoodsController::class);

Route::get('/view/goods/{id}', [\App\Http\Controllers\GoodsController::class, 'view']);

Route::resource('variety', \App\Http\Controllers\GoodVarietyController::class);

Route::resource('payments', \App\Http\Controllers\PaymentsController::class);
Route::resource('orders', \App\Http\Controllers\OrderController::class);
Route::resource('users', \App\Http\Controllers\UsersController::class);
Route::resource('customer', \App\Http\Controllers\CustomerController::class);
Route::get('/customer/true/{id}', [\App\Http\Controllers\CustomerController::class, 'true']);
Route::post('/customer/true/{id}/activateMember', [\App\Http\Controllers\CustomerController::class, 'activateMember'])->name('activateMember');
Route::get('/customer/false/{id}', [\App\Http\Controllers\CustomerController::class, 'false']);
Route::post('/customer/false/{id}/deactivateMember', [\App\Http\Controllers\CustomerController::class, 'deactivateMember'])->name('deactivateMember');
Route::get('/customer/member/{id}', [\App\Http\Controllers\CustomerController::class, 'member']);
Route::post('/customer/member/{id}/changeStatus', [\App\Http\Controllers\CustomerController::class, 'changeStatus'])->name('changeStatus');


//Route::post('changeStatus', [App\Http\Controllers\CustomerController::class, 'changeStatus'])->name('changeStatus');
//Route::get('/home', [App\Http\Controllers\ProductViewController::class, 'productInfo'])->name('home');
//Route::get('/home', [App\Http\Controllers\ProductViewController::class, 'productInfo'])->name('home');
Route::get('/filterCategory/{category_id}', [\App\Http\Controllers\Controller::class, 'filterGoodBasedOnCategory'])->name('filterCategory');



