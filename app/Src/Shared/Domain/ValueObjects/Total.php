<?php

namespace App\Src\Shared\Domain\ValueObjects;

use InvalidArgumentException;

final class Total
{
    private function __construct(private readonly int $value) {}

    public static function create(int $value): self
    {
        if ($value < 0) {
            throw new InvalidArgumentException('El total no debe ser menor que cero.');
        }

        return new self($value);
    }

    public function value(): int
    {
        return $this->value;
    }
}
