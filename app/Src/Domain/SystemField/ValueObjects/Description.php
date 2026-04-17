<?php

namespace App\Src\Domain\SystemField\ValueObjects;

use InvalidArgumentException;

final class Description
{
    private function __construct(private readonly string $value) {}

    public static function create(string $value): self
    {
        self::validate($value);

        return new self($value);
    }

    private static function validate(string $value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException('La descripción del campo del sistema no debe estar vacío.');
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(Description $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return '{
            "description": "'.$this->value.'"
        }';
    }
}
