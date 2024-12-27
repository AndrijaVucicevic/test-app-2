<?php


namespace App\Enums\Audit;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Tag;

enum TrackingAttributeEnum: string
{
    case ORDER = Order::class;

    public function attributes(): array
    {
        return match ($this) {
            self::ORDER => [
                'order_date' => __('messages.order_date'),
                'channel' => __('messages.channel'),
                'sku' => __('messages.sku'),
                'item_description' => __('messages.item_description'),
                'origin' => __('messages.origin'),
                'so_num' => __('messages.so_num'),
                'cost' => __('messages.cost'),
                'shipping_cost' => __('messages.shipping_cost'),
                'total_price' => __('messages.total_price'),
            ],
        };
    }
}
