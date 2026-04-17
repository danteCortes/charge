<?php

namespace App\Src\Domain\SystemField\Enums;

enum Required: string
{
    case YES = 'SI';
    case NO = 'NO';

    public function isPositive(): bool
    {
        return $this === self::YES;
    }

    public static function fromString(string $value): self
    {
        return match ($value) {
            'SI' => self::YES,
            'NO' => self::NO,
            default => InvalidArgumentException(
                "Invalid mode: {$value}. ".
                'Allowed values: SI, NO.'
            )
        };
    }
}
