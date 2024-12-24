<?php

namespace App\Services\Log;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Level;
use Monolog\LogRecord;

class DatabaseLoggingHandler extends AbstractProcessingHandler
{

    public function __construct(int|string|Level $level = Level::Debug, bool $bubble = true, protected $config = [])
    {
        parent::__construct($level, $bubble);
    }

    protected function write(LogRecord $record): void
    {
        $context = $record['context'];
        $context['session_id'] = session()->getId();

        $data = [
            'message' => $record['message'],
            'context' => json_encode($context, JSON_THROW_ON_ERROR),
            'level' => $record['level'],
            'level_name' => $record['level_name'],
            'channel' => $record['channel'] ?? 'dblog',
            'date' => $record['datetime']->format('Y-m-d H:i:s'),
            'extra' => json_encode($record['extra'], JSON_THROW_ON_ERROR),
            'formatted' => $record['formatted'],
            'url' => request()?->fullUrl(),
            'payload' => json_encode(request()?->all(), JSON_THROW_ON_ERROR),
            'user_id' => Auth::user()?->id,
            'user_email' => Auth::user()?->email,
            'remote_address' => request()?->ip(),
            'user_agent' => request()?->header('User-Agent'),
        ];

        DB::connection('database_log')->table('logs')->insert($data);
    }
}
