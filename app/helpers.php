<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;

if (!function_exists('dblog')) {
    function dblog(): LoggerInterface
    {
        return Log::channel('dblog');
    }
}

if (!function_exists('dynamicConfig')) {
    function dynamicConfig($key)
    {
        $config = DB::table('dynamic_configs')->where('key', $key)->first();
        return $config ? json_decode($config->value, true) : null;
    }
}

if (!function_exists('user')) {
    function user(): ?User
    {
        return Auth::user();
    }
}
