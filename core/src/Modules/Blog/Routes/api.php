<?php

use Illuminate\Http\Request;
use Rahweb\CmsCore\Modules\Blog\Http\Controllers\Api\V1\BlogController;
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
    Route::get('/v1/blogs', [BlogController::class, "getIndex"])->name('category-list');
    Route::get('/v1/blogs/{url}', [BlogController::class, "getList"])->name('blog-list');
    Route::get('/v1/blog/{url}', [BlogController::class, "getDetail"])->name('blog-detail');
});
