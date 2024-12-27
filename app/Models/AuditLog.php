<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $table = 'audit_logs';
    protected $connection = 'database_log';

    protected $fillable = [
        'user_id',
        'action_type',
        'message',
        'owner',
        'content',
        'meta',
        'meta_html',
        'order_id',
        'import_log_id'
    ];

    protected $casts = [
        'meta' => 'json',
    ];
}
