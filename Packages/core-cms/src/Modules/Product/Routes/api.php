<?php

use Rahweb\CmsCore\Modules\Product\Http\Controllers\Api\V1\BrandController;
use Rahweb\CmsCore\Modules\Product\Http\Controllers\Api\V1\ProductCategoryController;
use Rahweb\CmsCore\Modules\Product\Http\Controllers\Api\V1\ProductController;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('api.')->group(function () {
    //cat
    Route::get('/v1/categories', [ProductCategoryController::class, "getList"])->name('category-list');
    Route::get('/v1/category/{url}', [ProductCategoryController::class, "getProductList"])->name('product-list');
    Route::post('/v1/product-cat-vue/', [ProductCategoryController::class, "getProductListVue"])->name('product-list-vue');
    //brand
    Route::get('/v1/brands', [BrandController::class, "getList"])->name('brand-list');
    Route::get('/v1/brand/{url}', [BrandController::class, "getProductList"])->name('brand-detail');
    Route::post('/v1/product-brand-vue/', [BrandController::class, "getProductListVue"])->name('product-list-vue');
    //product
    Route::get('/v1/product/{url}', [ProductController::class, "getProductDetail"])->name('product-detail');
    Route::get('/v1/discounted-products', [ProductController::class, "getDiscountedProductTest"])->name('discounted-products');

});
