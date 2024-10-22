<?php

use Rahweb\CmsCore\Modules\Banner\Http\Controllers\BannerController;

Route::prefix('admin/banner')->name('admin.banner.')->group(function() {
    Route::controller(BannerController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/edit/{id}', 'update')->name('edit');
        Route::get('/delete/{id}', 'destroy')->name('delete');
    });
});
