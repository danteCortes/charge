<?php

namespace App\Src\Shared\Domain\ValueObjects;

use InvalidArgumentException;

final class From
{
    private function __construct(private readonly int $value) {}

    public static function create(int $value): self
    {
        if ($value <= 0) {
            throw new InvalidArgumentException('La página desde debe ser mayor que cero.');
        }

        return new self($value);
    }

    public function value(): int
    {
        return $this->value;
    }
}
