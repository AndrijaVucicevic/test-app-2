<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_date',
        'channel',
        'sku',
        'item_description',
        'origin',
        'so_num',
        'cost',
        'shipping_cost',
        'total_price',
        'import_log_id'
    ];


    public function product()
    {
        return $this->hasOne(Product::class, 'sku', 'sku');
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class, 'order_id', 'id');
    }
}
