<?php

namespace App\Repositories;


use App\Models\ImportLog;
use App\Repositories\Interfaces\ImportRepositoryInterface;

class ImportRepository extends BaseRepository implements ImportRepositoryInterface
{
    public function __construct(ImportLog $importLog)
    {
        parent::__construct($importLog);
    }

    public function table()
    {
        $query = $this->model->newQuery()
            ->select('import_logs.*')
            ->with('user')
            ->orderBy('id', 'desc')
            ->paginate()->appends(request()->query());

        return $query;
    }
}
