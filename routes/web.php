<?php

use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ItemsController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\DetailController;
use App\Http\Controllers\Front\LandingController;
use App\Http\Controllers\Front\PaymentController;
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

Route::name('front.')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('index');
    Route::get('/detail/{slug}', [DetailController::class, 'index'])->name('detail');


    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/checkout/{slug}', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/checkout/{slug}', [CheckoutController::class, 'store'])->name('checkout.store');

        Route::get('/payment/{bookingId}', [PaymentController::class, 'index'])->name('payment');
        
        Route::post('/payment/{bookingId}', [PaymentController::class, 'update'])->name('payment.update');
    });
});

Route::prefix('admin')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('brands', BrandController::class);
    Route::resource('type', TypeController::class);
    Route::resource('items', ItemsController::class);
    Route::resource('bookings', BookingController::class);
});
