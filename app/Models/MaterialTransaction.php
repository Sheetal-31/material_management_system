<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaterialTransaction extends Model
{
    protected $fillable = [
        'material_id',
        'transaction_date',
        'quantity'
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'quantity' => 'float'
    ];

    /**
     * Get the material that owns the transaction.
     */
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
} 