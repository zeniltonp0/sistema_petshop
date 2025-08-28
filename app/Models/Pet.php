<?php

namespace App\Models;

use App\Enums\{EspecieEnum, RacaEnum};
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Pet extends Model
{
    use HasFactory;
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function agendamentos(): HasMany
    {
        return $this->hasMany(Agendamento::class);
    }

    protected $casts = [
        'especie'         => EspecieEnum::class,
        'raca'            => RacaEnum::class,
        'data_nascimento' => 'date',
    ];
}
