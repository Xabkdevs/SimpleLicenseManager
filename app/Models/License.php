<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class License extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_key',
        'first_name',
        'last_name',
        'brand_name',
        'phone',
        'os',
        'additional_data',
        'status',
        'expires_at',
    ];

    protected $casts = [
        'additional_data' => 'array',
        'expires_at' => 'datetime',
    ];

    /**
     * Check if the license is active
     */
    public function isActive(): bool
    {
        return $this->status === 'active' && 
               ($this->expires_at === null || $this->expires_at->isFuture());
    }

    /**
     * Check if the license is expired
     */
    public function isExpired(): bool
    {
        return $this->status === 'expired' || 
               ($this->expires_at !== null && $this->expires_at->isPast());
    }

    /**
     * Get the full name attribute
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->first_name . ' ' . $this->last_name,
        );
    }

    /**
     * Scope for active licenses
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for inactive licenses
     */
    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }

    /**
     * Scope for expired licenses
     */
    public function scopeExpired($query)
    {
        return $query->where('status', 'expired');
    }
}
