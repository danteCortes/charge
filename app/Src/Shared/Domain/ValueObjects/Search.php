<?php

namespace App\Src\Shared\Domain\ValueObjects;

use InvalidArgumentException;

final class Search
{
    private function __construct(private readonly string $value) {}

    public static function create(string $value): self
    {
        if (empty($value)) {
            throw new InvalidArgumentException('la búsqueda no debe estar vacío');
        }

        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }
}
