<?php

namespace App\Data;

use App\Helpers\DateTimeHelper;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class OrderData extends Data
{

    public function __construct(
        public int $id,
        #[MapInputName('order_date')]
        public string $orderDate,
        public string $channel,
        public string $sku,
        #[MapInputName('item_description')]
        public string|null $itemDescription,
        public string $origin,
        #[MapInputName('so_num')]
        public string $soNum,
        public string $cost,
        #[MapInputName('shipping_cost')]
        public string $shippingCost,
        #[MapInputName('total_price')]
        public string $totalPrice,
        #[MapInputName('created_at')]
        public string $createdAt,
    ) {
        $this->orderDate = DateTimeHelper::formatDateTime($this->orderDate, 'Y-m-d');
        $this->createdAt = DateTimeHelper::formatDateTime($this->createdAt);
    }
}
