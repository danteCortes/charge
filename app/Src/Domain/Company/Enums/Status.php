<?php

namespace App\Src\Domain\Company\Enums;

enum Status: string
{
    case ACTIVE = 'Activo';
    case INACTIVE = 'Inactivo';

    public function isActive(): bool
    {
        return $this === self::ACTIVE;
    }

    public static function fromString(string $value): self
    {
        return match ($value) {
            'Activo' => self::ACTIVE,
            'Inactivo' => self::INACTIVE,
            default => InvalidArgumentException(
                "Invalid mode: {$value}. ".
                'Allowed values: Activo, Inactivo.'
            )
        };
    }
}
