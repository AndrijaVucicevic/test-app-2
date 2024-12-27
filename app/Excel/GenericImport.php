<?php

namespace App\Excel;

use App\Models\ImportLog;
use App\Services\Import\SaveImportLogService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class GenericImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    protected $type;
    protected $config;
    private $importLog;

    public function __construct($config, $type, ImportLog $importLog)
    {
        $this->config = $config;
        $this->type = $type;
        $this->importLog = $importLog;
    }

    public function collection(Collection $rows)
    {
        $errorReport = [];

        foreach ($rows as $index => $row) {
            $mappedRow = $this->mapHeaders($row->toArray());

            $validator = Validator::make($mappedRow, $this->config['validation']);

            if ($validator->fails()) {
                $messages = [];
                $allMessages = $validator->errors()->messages();
                foreach ($allMessages as $field => $fieldErrors) {
                    $messages = array_merge($messages, $fieldErrors);
                }

                $errorReport[] = [
                    'item' => $mappedRow,
                    'reason' => join(' && ', $messages)
                ];
                continue;
            }

            $model = DB::table($this->type);
            if (count($this->config['update_or_create']) > 0) {
                $result = array_intersect_key($mappedRow, array_flip($this->config['update_or_create']));
                $row = $model->where($result)->first();
                if (!$row) {
                    $mappedRow['import_log_id'] = $this->importLog->id;
                    $model->insert($mappedRow);
                } else {
                    $before = $row->toArray();
                    $row->update($mappedRow);

                    audit()->trackAttributes(class_basename(get_class($row))::class)->log(
                        type: sprintf('Import job',),
                        meta: ['before' => $before, 'after' => $row->toArray()],
                        importLogId: $this->importLog->id,
                    );
                }
            } else {
                $model->insert($mappedRow);
            }
        }
        $service = App::make(SaveImportLogService::class);
        $service->execute($this->importLog, $errorReport, $this->config);
    }

    protected function mapRowToDatabase(array $row): array
    {
        $mapped = [];
        foreach ($row as $key => $value) {
            $mapped[$key] = $value ? trim($value) : '';
        }
        return $mapped;
    }

    protected function getUniqueKey(array $row): array
    {
        $uniqueKeys = array_keys($this->config['headers_to_db']);
        return array_intersect_key($row, array_flip($uniqueKeys));
    }

    protected function logError(int $rowNumber, array $errors, array $rowData) {}

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    protected function mapHeaders(array $row): array
    {
        $mapped = [];
        foreach ($this->config['headers_to_db'] as $dbColumn => $fileHeader) {
            $header = strtolower(trim($fileHeader));
            $header = str_replace(' ', '_', $header);

            $mapped[$dbColumn] = trim($row[$header]) ?? null;
        }
        return $mapped;
    }
}
