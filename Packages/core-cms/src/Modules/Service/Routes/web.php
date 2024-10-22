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

use Rahweb\CmsCore\Modules\Service\Http\Controllers\ServiceController;
use Rahweb\CmsCore\Modules\Service\Http\Controllers\FeeController;
use Rahweb\CmsCore\Modules\Service\Http\Controllers\PackageController;
use Rahweb\CmsCore\Modules\Service\Http\Controllers\WorkSampleController;

Route::controller(WorkSampleController::class)
    ->prefix('admin/worksample')
    ->name('admin.worksample.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create/', 'create')->name('create');
        Route::post('/create/', 'store')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/edit/{id}', 'update')->name('edit');
        Route::get('/delete/{id}', 'destroy')->name('delete');
        Route::get('/image/{id}', 'images')->name('image');
        Route::get('/thumbnail/{id}', 'thumbnail')->name('thumbnail');
        Route::get('/delete-image/{id}', 'deleteImage')->name('delete-image');
        Route::post('/create-image/{id}', 'createImage')->name('create-image');
    });


Route::controller(PackageController::class)
    ->prefix('admin/package')
    ->name('admin.package.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/edit/{id}', 'update')->name('edit');
        Route::get('/delete/{id}', 'destroy')->name('delete');
    });


Route::controller(FeeController::class)
    ->prefix('admin/fee')
    ->name('admin.fee.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/edit/{id}', 'update')->name('edit');
        Route::get('/delete/{id}', 'destroy')->name('delete');
    });

Route::middleware('AdminPermission')->prefix('admin/service')->name('admin.service.')->group(function () {
    Route::controller(ServiceController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/edit/{id}', 'update')->name('edit');
        Route::get('/delete/{id}', 'destroy')->name('delete');
        Route::get('/delete-root/{id}', 'deleteRoot')->name('delete-root');
    });
});
