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

    // nessa função, vai conter a lógica de que, algumas raças só podem estar relacionadas com alguma especie.
    public function especie(): EspecieEnum
    {
        return match($this) {
            self::GOLDEN_RETRIEVER, self::LABRADOR, self::BULLDOG, self::VIRA_LATA_CARAMELO => EspecieEnum::CACHORRO,
            self::SIAMES, self::PERSA, self::SPHYNX => EspecieEnum::GATO,
            self::CANARIO, self::PERIQUITO => EspecieEnum::PASSARO,
            default => EspecieEnum::OUTRO,
        };
    }

    // aqui vai ser o filtro pra inserir dentro de um array de racas de uma determinada especie
    public static function fromEspecie(EspecieEnum $especie): array
    {
        $racas = array_filter(
            self::cases(),
            fn ($raca) => $raca->especie() === $especie
        );

        if ($especie !== EspecieEnum::OUTRO) {
            $racas[] = self::NAO_DEFINIDA;
        }

        return $racas;
    }
}
