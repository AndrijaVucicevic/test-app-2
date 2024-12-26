<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicConfig extends Model
{
    use HasFactory;

    protected $table = 'dynamic_configs';
    protected $fillable = ['key', 'value'];
}
