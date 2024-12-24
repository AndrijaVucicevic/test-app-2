<?php

use Illuminate\Support\Facades\Log;
use Psr\Log\LoggerInterface;

if (!function_exists('dblog')) {
    function dblog(): LoggerInterface
    {
        return Log::channel('dblog');
    }
}

