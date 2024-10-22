<?php

use Rahweb\CmsCore\Modules\User\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/users')->group(function (){
   Route::get('', [UserController::class, 'users']);
});
