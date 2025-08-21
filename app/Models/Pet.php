<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pet extends Model
{
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
