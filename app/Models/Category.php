<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = ['name', 'is_active'];

    /**
     * Get the materials for the category.
     */
    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }
} 