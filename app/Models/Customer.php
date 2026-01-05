<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The guard associated with the model.
     */
    protected $guard = 'customer';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
    ];

    /**
     * The attributes that should be hidden.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'password' => 'hashed',
    ];

    /**
     * Check if customer account is active.
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    /**
     * Presence relationship (WebSocket tracking).
     */
    public function presence()
    {
        return $this->morphOne(UserPresenceLog::class, 'user');
    }
}
