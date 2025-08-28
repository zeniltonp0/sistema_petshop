<?php

namespace App\Models;

use App\Enums\{EspecieEnum, RacaEnum};
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany};
use Illuminate\Support\Facades\Storage;

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

    protected function fotoUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->foto_pet) {
                    return Storage::disk('public')->url($this->foto_pet);
                }

                return 'https://placehold.co/400x300/a1a1aa/ffffff?text=Sem+Foto';
            }
        );
    }
}
