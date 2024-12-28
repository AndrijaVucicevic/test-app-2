<?php


namespace App\Services\Import;

use App\Models\ImportLog;

class DownloadImportService
{

    public function execute(ImportLog $importLog): bool
    {
        $content = file_get_contents($importLog->file_error_csv);

        header("Content-type: application/csv; charset=utf-8");
        header("Content-Disposition: attachment; filename=import-report.csv");
        $fp = fopen('php://output', 'w');

        fputs($fp, $content);

        return true;
    }
}
