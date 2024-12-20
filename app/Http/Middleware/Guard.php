<?php

namespace App\Http\Middleware;

use App\Auth\Guard as GuardHelper;
use App\Enum\RoutePermissionAdminCg;
use App\Enum\RoutePermissionComplaint;
use App\Enums\AppConst\RoleEnum;
use Closure;
use Illuminate\Http\Request;
use App\Enums\RoutePermissionExecutor;
use Illuminate\Support\Facades\Auth;

class Guard
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        
        if ($user->hasRole(RoleEnum::Admin->value)) {
            return $next($request);
        }

        return redirect()->route('login');
    }
}
