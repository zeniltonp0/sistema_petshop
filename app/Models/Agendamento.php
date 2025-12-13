<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Agendamento extends Model
{
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    public function servico(): BelongsTo
    {
        return $this->belongsTo(Servico::class);
    }

    public function getHorarioFormatadoAttribute(): string
    {
        return $this->data_hora_inicio->format('H:i') . ' - ' . $this->data_hora_fim->format('H:i'); // @phpstan-ignore-line
    }
}
