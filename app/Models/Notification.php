<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'request_id',
        'action'
    ];

    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }
}
