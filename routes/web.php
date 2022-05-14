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
Route::get('/notifications/admin', [\App\Http\Controllers\NotificationController::class, 'admin']);

Route::resource('variety', \App\Http\Controllers\GoodVarietyController::class);
Route::resource('notifications', \App\Http\Controllers\NotificationController::class);
Route::resource('payments', \App\Http\Controllers\PaymentsController::class);
Route::resource('orders', \App\Http\Controllers\OrderController::class);
Route::resource('users', \App\Http\Controllers\UsersController::class);


//Route::get('/home', [App\Http\Controllers\ProductViewController::class, 'productInfo'])->name('home');
//Route::get('/home', [App\Http\Controllers\ProductViewController::class, 'productInfo'])->name('home');
Route::get('/filterCategory/{category_id}', [\App\Http\Controllers\Controller::class, 'filterGoodBasedOnCategory'])->name('filterCategory');

//mail for promotion
Route::get('/email/promotion', function(){
    \Illuminate\Support\Facades\Mail::to('102761134@students.swinburne.edu.my')->send(new \App\Mail\PromotionMail());
    return new \App\Mail\PromotionMail();
});
//mail for voucher
Route::get('/email/voucher', function(){
    return new \App\Mail\VoucherMail();
});
//mail for order
Route::get('/email/order', function(){
    return new \App\Mail\OrderMail();
});
Route::get('/email/order', [\App\Http\Controllers\NotificationController::class, 'orderStatus']);
//mail for membership
Route::get('/email/membership', function(){
    return new \App\Mail\MembershipMail();
});

Route::get('/promotion', [\App\Http\Controllers\NotificationController::class,'createPromotion'])->name('createPromotion');
Route::get('/voucher', [\App\Http\Controllers\NotificationController::class,'createVoucher'])->name('createVoucher');
