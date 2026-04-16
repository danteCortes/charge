<?php

namespace App\Src\Domain\Enums;

enum FileStatus: string
{
    case PENDING = 'Pendiente';
    case PROCESS = 'Procesando';
    case READY = 'Listo';

    public static function fromString(string $value): self
    {
        return match ($value) {
            'Pendiente' => self::PENDING,
            'Procesando' => self::PROCESS,
            'Listo' => self::READY,
            default => throw new InvalidArgumentException(
                "Invalid decimal separator: {$value}. ".
                'Allowed values: Pendiente, Procesando, Listo'
            )
        };
    }
}
