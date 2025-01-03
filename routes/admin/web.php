<?php

use App\Http\Controllers\Admin\Users\IndexController as UsersController;
use App\Http\Controllers\Admin\Permissions\IndexController as PermissionsController;
use App\Http\Controllers\Admin\Import\IndexContoller as ImportController;
use App\Http\Controllers\Admin\Order\IndexController as OrderController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::resource('users', UsersController::class)->except('show');
    Route::put('/users/{user}/permissions', [UsersController::class, 'updatePermissions'])->name('users.permissions');
    Route::resource('permissions', PermissionsController::class)->except('show');
    Route::resource('imports', ImportController::class)->only(['index', 'create', 'store','edit']);
    Route::resource('orders', OrderController::class)->only(['index', 'destroy']);

    Route::get('/imports/{importLog}/file/download', [ImportController::class, 'download'])->name('imports-download');
    Route::get('/orders/{order}/history', [OrderController::class, 'history'])->name('orders-history');
});
