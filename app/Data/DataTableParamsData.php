<?php


namespace App\Data;

use Illuminate\Http\Request;
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

    public static function fromRequest(Request $request): self
    {
        return new self(
            start: $request->input('start', 0),
            length: $request->input('length', 10),
            order: $request->input('order', []),
            search: $request->input('search', []),
            draw: $request->input('draw', 1)
        );
    }
}
