<?php

use App\Http\Controllers\Admin\Import\IndexContoller as ImportController;
use App\Http\Controllers\Admin\Permissions\IndexController as PermissionsController;
use App\Http\Controllers\Admin\Users\IndexController as UsersController;
use App\Http\Controllers\Admin\Order\IndexController as OrdersController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/api/users/data', [UsersController::class, 'getData'])->name('users.data');
    Route::get('/api/users/{user}/permissions', [UsersController::class, 'getPermissions'])->name('users.permisssions');
    Route::get('/api/permissions/data', [PermissionsController::class, 'getData'])->name('permissions.data');
    Route::get('/api/orders/data', [OrdersController::class, 'getData'])->name('orders.data');
    
    Route::get('/api/imports/{importType}/headers', [ImportController::class, 'getHeaders'])->name('imports.headers');
});
