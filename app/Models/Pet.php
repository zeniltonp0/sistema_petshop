<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nome',
        'especie',
        'raca',
        'data_nascimento',
        'foto_pet',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function agendamentos(): HasMany
    {
        return $this->hasMany(Agendamento::class);
    }

    public function raca(): BelongsTo
    {
        return $this->belongsTo(Raca::class);
    }

    public function especie(): BelongsTo
    {
        return $this->belongsTo(Especie::class);
    }

    protected $casts = [
        'data_nascimento' => 'date',
    ];
}
