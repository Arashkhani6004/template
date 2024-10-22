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

use Rahweb\CmsCore\Modules\Product\Http\Controllers\BrandController;
use Rahweb\CmsCore\Modules\Product\Http\Controllers\ImageController;
use Rahweb\CmsCore\Modules\Product\Http\Controllers\ProductCategoryController;
use Rahweb\CmsCore\Modules\Product\Http\Controllers\ProductController;
use Rahweb\CmsCore\Modules\Product\Http\Controllers\ProductDetailController;
use Rahweb\CmsCore\Modules\Product\Http\Controllers\SpecificationController;
use Rahweb\CmsCore\Modules\Product\Http\Controllers\SpecificationValueController;
use Rahweb\CmsCore\Modules\Product\Http\Controllers\VariantController;

Route::middleware('AdminPermission')->group(function() {
    Route::controller(SpecificationController::class)
        ->prefix('admin/specification')
        ->name('admin.specification.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('edit');
            Route::get('/delete/{id}', 'destroy')->name('delete');
        });
    Route::controller(SpecificationValueController::class)
        ->prefix('admin/specification-value')
        ->name('admin.specification-value.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('edit');
            Route::get('/delete/{id}', 'destroy')->name('delete');
            //vue
            Route::get('/vue-values', 'values')->name('values')->withoutMiddleware('AdminPermission');
            Route::post('/save-values', 'saveValue')->name('save-values')->withoutMiddleware('AdminPermission');
            Route::post('/update-values', 'updateValue')->name('update-values')->withoutMiddleware('AdminPermission');
        });

});


Route::middleware('AdminPermission')->group(function() {
    //category
    Route::controller(ProductCategoryController::class)
        ->prefix('admin/product-category')
        ->name('admin.product-category.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('edit');
            Route::get('/delete/{id}', 'destroy')->name('delete');
            Route::get('/delete-root/{id}', 'deleteRoot')->name('delete-root');
        });
    //brand
    Route::controller(BrandController::class)
        ->prefix('admin/brand')
        ->name('admin.brand.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('edit');
            Route::get('/delete/{id}', 'destroy')->name('delete');
        });
    //product
    Route::controller(ProductController::class)
        ->prefix('admin/product')
        ->name('admin.product.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/edit/{id}', 'update')->name('edit');
            Route::get('/delete/{id}', 'destroy')->name('delete');
            Route::post('/timer', 'timer')->name('timer');
        });
    Route::controller(ProductDetailController::class)
        ->prefix('admin/product/video-faq')
        ->name('admin.product-video-faq.')
        ->group(function () {
            //vue
            Route::get('/vue-videos', 'videos')->name('list')->withoutMiddleware('AdminPermission');
            //
            Route::get('/{id}', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('create');
            Route::get('/delete-video/{id?}', 'destroyVideo')->name('delete-video');
            Route::get('/delete-faq/{id?}', 'destroyFaq')->name('delete-faq');

        });
    Route::controller(ProductDetailController::class)
        ->prefix('admin/product/property-spf-tag')
        ->name('admin.product-property-spf-tag.')
        ->group(function () {
            //vue
            Route::get('/vue-props', 'props')->name('list')->withoutMiddleware('AdminPermission');
            Route::get('/vue-product-sps', 'productSpecification')->name('product-specification')->withoutMiddleware('AdminPermission');
            //
            Route::get('/{id}', 'indexProp')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'storeProp')->name('create');
            Route::get('/delete-prop/{id?}', 'destroyProp')->name('delete-prop');
            Route::get('/delete-product-specification/{id?}', 'destroyProductSpecification')
                ->name('delete-product-specification')->withoutMiddleware('AdminPermission');

        });
    Route::controller(ImageController::class)
        ->prefix('admin/product/image')
        ->name('admin.product-image.')
        ->group(function () {
            Route::get('/{id}', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('create');
        });
    Route::controller(VariantController::class)
        ->prefix('admin/product/variant')
        ->name('admin.product-variant.')
        ->group(function () {
            //vue
            Route::get('/vue-variants', 'variants')->name('list')->withoutMiddleware('AdminPermission');
            Route::get('/{id}', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/create', 'store')->name('create');
            Route::post('/create-main', 'storeMain')->name('create-main');
            Route::get('/delete/{id?}', 'destroy')->name('delete');



        });

});
