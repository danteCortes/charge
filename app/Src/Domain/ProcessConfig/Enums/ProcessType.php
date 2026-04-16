<?php

namespace App\Src\Domain\ProcessConfig\Enums;

enum ProcessType: string
{
    case FLOW = 'Flujo';
    case REFRESH = 'Refresco';

    public function isPositive(): bool
    {
        return $this === self::FLOW;
    }

    public static function fromString(string $value): self
    {
        return match ($value) {
            'Flujo' => self::FLOW,
            'Refresco' => self::REFRESH,
            default => InvalidArgumentException(
                "Invalid mode: {$value}. ".
                'Allowed values: Flujo, Refresco.'
            )
        };
    }
}
