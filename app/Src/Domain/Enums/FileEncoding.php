<?php

namespace App\Src\Domain\Enums;

enum FileEncoding: string {
    case UTF8 = 'UTF-8';
    case LATIN1 = 'Latin1';
    case WINDOWS1252 = 'Windows-1252';

    public static function fromString(string $value): self
    {
        return match($value) {
            'UTF-8' => self::UTF8,
            'Latin1' => self::LATIN1,
            'Windows-1252' => self::WINDOWS1252,
            default => throw new InvalidArgumentException(
                "Invalid decimal separator: {$value}. ".
                "Allowed values: UTF-8, Latin1, Windows-1252"
            )
        };
    }
}