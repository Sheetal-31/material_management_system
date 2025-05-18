<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'opening_balance',
        'is_active'
    ];

    /**
     * Get the category that owns the material.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the transactions for the material.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(MaterialTransaction::class);
    }

    /**
     * Get the current balance of the material.
     */
    public function getCurrentBalanceAttribute(): float
    {
        $transactionsSum = $this->transactions()->sum('quantity');
        return $this->opening_balance + $transactionsSum;
    }
} 