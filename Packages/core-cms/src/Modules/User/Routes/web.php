<?php

use Rahweb\CmsCore\Modules\User\Http\Controllers\AuthController;
use Rahweb\CmsCore\Modules\User\Http\Controllers\PermissionController;
use Rahweb\CmsCore\Modules\User\Http\Controllers\UserController;

Route::prefix('admin')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'login')->name('admin.login');
        Route::get('/logout', 'logout')->name('admin.logout');
        Route::post('/postLogin', 'postLogin');
        Route::get('/change-password', 'changePassword')->name('admin.change-password');;
    });
});

Route::middleware('AdminPermission')->group(function () {
Route::controller(UserController::class)
    ->prefix('admin/user')->name('admin.user.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/edit/{id}', 'update')->name('edit');
        Route::get('/delete/{id}', 'destroy')->name('delete');
        Route::patch('/change-password/{id}', 'changePassword')->name('change-password');
    });

Route::controller(PermissionController::class)
    ->prefix('admin/permission')->name('admin.permission.')
    ->group(function () {
        Route::get('/', 'getPermission')->name('index');
        Route::get('/add', 'getAddPermission')->name('add');
        Route::post('/add', 'postAddPermission')->name('add');
        Route::get('/edit/{id}', 'getEditPermission')->name('edit');
        Route::post('/edit/{id}', 'postEditPermission')->name('edit');
        Route::get('/delete/{id}', 'getDeletePermission')->name('delete');
    });

});
