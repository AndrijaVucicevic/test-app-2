<?php


namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class GlobalComposer
{
    public function compose(View $view)
    {
        $view->with('currentRoute', Route::currentRouteName());
        $view->with('user', Auth::user());
    }
}