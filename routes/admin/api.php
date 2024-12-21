<?php

use App\Http\Controllers\Admin\Permissions\IndexController as PermissionsController;
use App\Http\Controllers\Admin\Users\IndexController as UsersController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/api/users/data', [UsersController::class, 'getData'])->name('users.data');
    Route::get('/api/permissions/data', [PermissionsController::class, 'getData'])->name('permissions.data');
});
