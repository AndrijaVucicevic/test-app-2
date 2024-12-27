<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Spatie\LaravelData\DataCollection;

interface AuditServiceInterface
{

    public function log(
        string      $type,
        array       $meta = [],
        int|null    $userId = null,
    ): void;

    public function logBulk(string $type, array $data): void;

}