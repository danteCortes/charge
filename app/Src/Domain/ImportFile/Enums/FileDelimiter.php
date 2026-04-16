<?php

namespace App\Src\Domain\ImportFile\Enums;

enum FileDelimiter: string
{
    case SEMICOLON = ';';
    case COMMA = ',';
    case VERTICAL_BAR = '|';
    case TAB = "\t";

    public static function fromString(string $value): self
    {
        return match ($value) {
            ';' => self::SEMICOLON,
            ',' => self::COMMA,
            '|' => self::VERTICAL_BAR,
            "\t" => self::TAB,
            default => throw new \InvalidArgumentException(
                "Invalid file delimiter: {$value}. ".
                'Allowed values: ;, ,, |, \t'
            )
        };
    }
}
