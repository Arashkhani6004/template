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

use Rahweb\CmsCore\Modules\Page\Http\Controllers\PageController;

//Route::middleware('AdminPermission')->group(function() {
Route::controller(PageController::class)
    ->prefix('admin/page')
    ->name('admin.page.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/create', 'store')->name('create');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/edit/{id}', 'update')->name('edit');
        Route::get('/delete/{id}', 'destroy')->name('delete');
    });

//});
