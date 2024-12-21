<?php

use App\Http\Controllers\Admin\Users\IndexController as UsersController;
use App\Http\Controllers\Admin\Permissions\IndexController as PermissionsController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('users', UsersController::class)->except('show');
    Route::resource('permissions', PermissionsController::class)->except('show');
});
