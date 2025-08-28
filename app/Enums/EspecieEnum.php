<?php

namespace App\Enums;

enum EspecieEnum: string
{
    case CACHORRO = 'Cachorro';
    case GATO     = 'Gato';
    case PASSARO  = 'Pássaro';
    case HAMSTER  = 'Hamster';
    case OUTRO    = 'Outro';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
