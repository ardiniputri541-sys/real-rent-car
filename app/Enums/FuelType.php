<?php

namespace App\Enums;

enum FuelType: string
{
    case GASOLINE = 'bensin';
    case DIESEL = 'solar';
    case HYBRID = 'hybrid';
    case ELECTRIC = 'listrik';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function toArray(): array
    {
        return [
            self::GASOLINE->value,
            self::DIESEL->value,
            self::HYBRID->value,
            self::ELECTRIC->value,
        ];
    }

    public static function forFrontend(): array
    {
        return self::toArray();
    }
}
