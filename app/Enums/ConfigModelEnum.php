<?php


namespace App\Enums;

use App\Models\Order;
use Illuminate\Support\Facades\App;

enum ConfigModelEnum: string
{

    case ORDERS = 'orders';



    public function getModel()
    {
        return match ($this) {
            self::ORDERS => App::make(Order::class),
            default => throw new \Exception('To be implemented'),
        };
    }
}
