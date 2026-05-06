<?php

namespace App\Src\Domain\Company\ValueObjects;

use InvalidArgumentException;

final class FantasyName
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
            throw new InvalidArgumentException('El nombre de fantasía de la empresa no debe estar vacío.');
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(FantasyName $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return '{
            "value": "'.$this->value.'"
        }';
    }
}
