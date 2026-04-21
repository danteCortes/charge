<?php

namespace App\Src\Domain\ImportFile\ValueObjects;

use InvalidArgumentException;

final class DuplicatedRows
{
    private function __construct(private readonly int $value) {}

    public static function create(int $value): self
    {
        self::validate($value);

        return new self($value);
    }

    private static function validate(int $value): void
    {
        if ($value < 0) {
            throw new InvalidArgumentException('Las filas duplicadas del archivo no deben ser menor de cero.');
        }
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(DuplicatedRows $other): bool
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
