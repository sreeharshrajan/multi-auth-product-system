<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserPresenceLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_type',
        'is_online',
        'last_seen_at',
    ];

    protected $casts = [
        'is_online' => 'boolean',
        'last_seen_at' => 'datetime',
    ];

    public function user()
    {
        return $this->morphTo();
    }
}
