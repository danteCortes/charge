<?php

namespace App\Src\Domain\Enums;

enum FileDelimiter: string
{
    case SEMICOLON = 'Punto y coma (;)';
    case COMMA = 'Coma (,)';
    case VERTICAL_BAR = 'Barra vertical (|)';
    case TAB = 'Tabulación';

    public static function fromString(string $value): self
    {
        return match ($value) {
            'Punto y coma (;)' => self::SEMICOLON,
            'Coma (,)' => self::COMMA,
            'Barra vertical (|)' => self::VERTICAL_BAR,
            'Tabulación' => self::TAB,
            default => throw new InvalidArgumentException(
                "Invalid decimal separator: {$value}. ".
                'Allowed values: Punto y coma (;), Coma (,), Barra vertical (|), Tabulación'
            )
        };
    }
}
