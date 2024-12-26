<?php

namespace App\Jobs;

use App\Excel\GenericImport;
use App\Http\Requests\Import\StoreRequest;
use App\Models\DynamicConfig;
use App\Models\ImportLog;
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
            Log::alert('config', [$config]);
            Log::alert('file', [$this->importLog->file_csv]);
            Excel::import(new GenericImport($config, $array[0], $this->importLog), $this->importLog->file_csv);
        } catch (\Exception $e) {
            Log::error("Greška prilikom importa: {$e->getMessage()}");
            // Čuvanje greške u log tabeli
        }
    }

    protected function importData($data, $config)
    {
        foreach ($data as $row) {
            $validator = Validator::make($row, $config['validation']);

            if ($validator->fails()) {
                // Log::error("Greška validacije: {$validator->errors()}");
                // Čuvanje greške u log tabeli
                continue;
            }

            $model = DB::table($this->type);
            if ($config['update_or_create']) {
                $model->updateOrInsert(['id' => $row['id']], $row);
            } else {
                $model->insert($row);
            }
        }
    }
}
