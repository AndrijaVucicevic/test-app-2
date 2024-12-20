<?php

// Route::group([], __DIR__ . '/admin/api.php');
// Route::group([], __DIR__ . '/admin/web.php');

use Illuminate\Support\Facades\Route;


Route::group([], __DIR__ . '/public/web.php');
Route::group([], __DIR__ . '/admin/web.php');
Route::group([], __DIR__ . '/admin/api.php');