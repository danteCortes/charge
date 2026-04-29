<?php

namespace App\Src\Domain\ProcessConfig\Enums;

enum Status: string
{
    case PENDING = 'Pendiente';
    case IN_PROGRESS = 'En proceso';
    case PAUSED = 'Pausado';
    case ERROR = 'Error';
    case COMPLETED = 'Finalizado';
    case CANCELED = 'Cancelado';

    public static function fromString(string $value): self
    {
        return match ($value) {
            'Pendiente' => self::PENDING,
            'En proceso' => self::IN_PROGRESS,
            'Pausado' => self::PAUSED,
            'Error' => self::ERROR,
            'Finalizado' => self::COMPLETED,
            'Cancelado' => self::CANCELED,
            default => InvalidArgumentException(
                "Invalid mode: {$value}. ".
                'Allowed values: Pendiente, En proceso, Pausado, Error, Finalizado, Cancelado.'
            )
        };
    }
}
