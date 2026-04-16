<?php

namespace App\Src\Domain\ImportFile\Enums;

enum DecimalSeparator: string
{
    case COMMA = ',';
    case POINT = '.';

    public static function fromString(string $value): self
    {
        return match ($value) {
            ',' => self::COMMA,
            '.' => self::POINT,
            default => throw new \InvalidArgumentException(
                "Invalid decimal separator: {$value}. ".
                'Allowed values: ,, .'
            )
        };
    }
}
