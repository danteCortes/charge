<?php

namespace App\Src\Domain\ImportFile\ValueObjects;

use InvalidArgumentException;

final class ValidRows
{
    private function __construct(private readonly int $value){}

    public static function create(int $value): self {
        self::validate($value);
        return new self($value);
    }

    private static function validate(int $value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException('Las filas válidas del archivo no deben ser menor a cero.');
        }
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(ValidRows $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): int
    {
        return '{
            "value": "' . $this->value . '"
        }';
    }
}
