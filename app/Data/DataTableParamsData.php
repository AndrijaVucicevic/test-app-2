<?php


namespace App\Data;

use Spatie\LaravelData\Data;

class DataTableParamsData extends Data
{
    public function __construct(
        public int $start,
        public int $length,
        public array $order,
        public array $search,
        public int $draw
    ) {}
}
