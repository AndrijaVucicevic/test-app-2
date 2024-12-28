<?php

namespace App\Jobs;

use App\Enums\Logger\ChannelEnum;
use App\Enums\Logger\MessageEnum;
use App\Events\ImportErrorOccurred;
use App\Excel\GenericImport;
use App\Http\Requests\Import\StoreRequest;
use App\Models\DynamicConfig;
use App\Models\ImportLog;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $importLog;
    protected $type;

    public function __construct(ImportLog $importLog)
    {
        $this->type = $importLog->import_type;
        $this->importLog = $importLog;
    }

    public function handle()
    {
        try {

            $array = explode('_', $this->type);
            $type = DynamicConfig::where("key", $array[0])->firstOrFail();
            $config = json_decode($type->value, true)['files'][$array[1]];
            Excel::import(new GenericImport($config, $array[0], $this->importLog), $this->importLog->file_csv);
        } catch (Exception $e) {
            Log::error('eee', [$e->getMessage(), $e->getFile()]);
            dblog()->critical(MessageEnum::EXCEPTION->message($e->getMessage()), [
                ...ChannelEnum::EXCEPTION->log('import_job'),
                'import_log_id' => $this->importLog->id
            ]);

            event(new ImportErrorOccurred($e));
        }
    }
}
