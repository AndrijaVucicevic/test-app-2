<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\DateTimeHelper as DTH;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'orderDate' => $this->order_date,
            'channel' => $this->channel,
            'sku' => $this->sku,
            'itemDescription' => $this->item_description,
            'origin' => $this->origin,
            'soNum' => $this->so_num,
            'cost' => $this->cost,
            'shippingCost' => $this->shipping_cost,
            'totalPrice' => $this->total_price,
            'createdAt' => DTH::formatDateTime($this->created_at),
        ];
    }
}
