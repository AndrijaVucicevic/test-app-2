<?php

namespace App\Services\Log;

use Monolog\Logger;

class DatabaseLogger
{
    public function __invoke(array $config): Logger
    {
        return (new Logger('DatabaseLoggingHandler'))->pushHandler(new DatabaseLoggingHandler($config['level'], true, $config));
    }
}
