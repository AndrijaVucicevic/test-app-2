<?php

namespace App\Excel\Export;

use App\Data\OrderData;
use App\Filters\OrdersSearchFilter;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrdersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    public function __construct(
        private readonly OrdersSearchFilter $ordersSearchFilter,
        private readonly OrderRepositoryInterface $orderRepository
    ) {}

    public function headings(): array
    {
        return [
            __('messages.order_date'),
            __('messages.channel'),
            __('messages.sku'),
            __('messages.item_description'),
            __('messages.origin'),
            __('messages.so_num'),
            __('messages.cost'),
            __('messages.shipping_cost'),
            __('messages.total_price'),
            __('messages.created_at'),
        ];
    }

    public function map($row): array
    {
        $data = OrderData::from($row)->toArray();
        unset($data['id']);
        return $data;
    }

    public function collection(): Collection
    {
        return $this->orderRepository->table($this->ordersSearchFilter)->get();
    }
}
