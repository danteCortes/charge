<?php

namespace App\Src\Domain\Enums;

enum DecimalSeparator: string {
    case COMMA = 'Coma (,)';
    case POINT = 'Punto (.)';

    public static function fromString(string $value): self
    {
        return match($value) {
            'Coma (,)' => self::COMMA,
            'Punto (.)' => self::POINT,
            default => throw new InvalidArgumentException(
                "Invalid decimal separator: {$value}. ".
                "Allowed values: Coma (,), Punto (.)"
            )
        };
    }
}