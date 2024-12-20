<?php

use App\Http\Controllers\Admin\Users\IndexController as UsersController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/api/users/data', [UsersController::class, 'getData'])->name('users.data');
});
