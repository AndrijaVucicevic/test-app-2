<?php


namespace App\Services\Import;

use App\Enums\ImportStatusEnum;
use App\Models\ImportLog;
use Illuminate\Support\Facades\Log;

class SaveImportLogService
{

    public function execute(ImportLog $importLog, array $errorReport, array $config): void
    {
        try {
            unlink($importLog->file_csv);
        } catch (\Exception $e) {
        }

        $errorFile = storage_path('app/import/' . $importLog->id . '-report.csv');
        $importLog->update([
            'status' => count($errorReport) > 0
                ? ImportStatusEnum::ERROR->value
                : ImportStatusEnum::SUCCESS->value,
        ]);

        if (count($errorReport)) {
            file_put_contents(
                $errorFile,
                $this->_generateReportCsv($errorReport, $config)
            );
            $importLog->update([
                'file_error_csv' => $errorFile,
            ]);
        }
    }

    private function _generateReportCsv(array $errorReport, array $config): string
    {
        $hedersToDb = $config['headers_to_db'];
        $headers = array_values($hedersToDb);
        $headers[] = 'reason';
        $mappedHeaders = array_keys($hedersToDb);
        $mappedHeaders[] = 'reason';

        $headerRow = join(',', $headers);

        $errorItemRows = array_map(function ($errorItem) use ($mappedHeaders) {
            $row = array_map(function ($headerKey) use ($errorItem) {
                $rowItem = $headerKey != 'reason' ? $errorItem['item'][$headerKey] : $errorItem[$headerKey];
                return  $rowItem ?? '';
            }, $mappedHeaders);

            return join(',', $row); // Pretvaranje reda u string sa zarezima
        }, $errorReport);

        return $headerRow . "\n" . join("\n", $errorItemRows);
    }
}
