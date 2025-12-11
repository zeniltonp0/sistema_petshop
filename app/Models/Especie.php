<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Especie extends Model
{
    /** @use HasFactory<\Database\Factories\EspecieFactory> */
    use HasFactory;

    public function pet(): HasMany
    {
        return $this->hasMany(Pet::class);
    }
}
