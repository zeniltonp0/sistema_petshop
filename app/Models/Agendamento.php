<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agendamento extends Model
{
    use HasFactory;
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function servico(): BelongsTo
    {
        return $this->belongsTo(Servico::class);
    }
}
