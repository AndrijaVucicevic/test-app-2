<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImportLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'file_csv',
        'file_error_csv',
        'import_type',
        'user_id',
        'config'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
