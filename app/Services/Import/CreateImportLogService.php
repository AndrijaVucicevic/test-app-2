<?php


namespace App\Services\Import;

use App\Data\ImportLogData;
use App\Models\ImportLog;

class CreateImportLogService
{
    public function execute(ImportLogData $data): ImportLog
    {
        return ImportLog::create($data->toCreate());
    }
}
