<?php

namespace App\Enums;

enum RacaEnum: string
{
    // cachorros
    case GOLDEN_RETRIEVER   = 'Golden Retriever';
    case LABRADOR           = 'Labrador';
    case BULLDOG            = 'Bulldog';
    case VIRA_LATA_CARAMELO = 'Vira-lata Caramelo';

    // gatos
    case SIAMES = 'Siamês';
    case PERSA  = 'Persa';
    case SPHYNX = 'Sphynx';

    // pássaros
    case CANARIO   = 'Canário';
    case PERIQUITO = 'Periquito';

    case NAO_DEFINIDA = 'Não Definida';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
