<?php

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

use Rahweb\CmsCore\Modules\Order\Http\Controllers\BankController;
use Rahweb\CmsCore\Modules\Order\Http\Controllers\DiscountController;
use Rahweb\CmsCore\Modules\Order\Http\Controllers\OrderController;
use Rahweb\CmsCore\Modules\Order\Http\Controllers\OrderShippingStatusController;
use Rahweb\CmsCore\Modules\Order\Http\Controllers\ShippingMethodController;

Route::middleware('AdminPermission')->group(function() {
    Route::controller(BankController::class)
        ->prefix('admin/bank')
        ->name('admin.bank.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('edit');
        });
    Route::controller(OrderShippingStatusController::class)
        ->prefix('admin/order-shipping-status')
        ->name('admin.order-shipping-status.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('edit');
            Route::get('/delete/{id}', 'destroy')->name('delete');
        });
    Route::controller(ShippingMethodController::class)
        ->prefix('admin/shipping-method')
        ->name('admin.shipping-method.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('edit');
            Route::get('/delete/{id}', 'destroy')->name('delete');
        });
    Route::controller(DiscountController::class)
        ->prefix('admin/discount')
        ->name('admin.discount.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('edit');
            Route::get('/delete/{id}', 'destroy')->name('delete');
        });
    Route::controller(OrderController::class)
        ->prefix('admin/order')
        ->name('admin.order.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/change-shipping-status/{id}', 'changeShippingStatus')->name('change-shipping-status');
            Route::get('/detail/{id}', 'detail')->name('detail');
            Route::get('/delete/{id}', 'destroy')->name('delete');
            Route::get('/factor/{id}', 'factor')->name('factor');
        });
});


