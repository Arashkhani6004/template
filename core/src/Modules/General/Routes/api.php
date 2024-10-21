<?php

use Rahweb\CmsCore\Modules\General\Http\Controllers\Api\V1\FirstPageController;
use Rahweb\CmsCore\Modules\General\Http\Controllers\Api\V1\LayoutController;
use Rahweb\CmsCore\Modules\General\Http\Controllers\Api\V1\SearchController;
use Rahweb\CmsCore\Modules\Contact\Http\Controllers\Api\V1\ContactController;
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

    Route::get('/v1/first-page', [FirstPageController::class, "getFirstPageData"])->name('first-page');
    Route::get('/v1/setting', [LayoutController::class, "getLayoutData"])->name('setting');
    Route::get('/v1/search-api', [SearchController::class, "getData"])->name('search');
});
