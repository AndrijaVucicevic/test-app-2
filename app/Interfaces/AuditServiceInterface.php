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
        int         $ownerId,
        int|null    $userId = null,
        int|null    $orderId = null,
        int|null    $importLogId = null,
    ): void;

    public function logBulk(string $type, array $data): void;

}