<?php


namespace App\Http\View\Composers;

use App\Helpers\ImportConfigHelper;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class GlobalComposer
{
    public function compose(View $view)
    {
        $view->with('currentRoute', Route::currentRouteName());
        $view->with('user', Auth::user());
        $view->with('configFiles', ImportConfigHelper::getFiles());
        $view->with('fnOrdinalNumber', function (int $i) {
            $page = request()->get('page') ?? 1;
            $page--;
            return $page * 15 + ++$i;
        });
    }
}
