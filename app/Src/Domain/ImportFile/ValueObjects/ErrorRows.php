<?php

namespace App\Src\Domain\ImportFile\ValueObjects;

use InvalidArgumentException;

final class ErrorRows
{
    private function __construct(private readonly int $value){}

    public static function create(int $value): self {
        self::validate($value);
        return new self($value);
    }

    private static function validate(int $value): void
    {
        if ($value < 0) {
            throw new InvalidArgumentException('Las filas con error del archivo no debe ser menor de cero.');
        }
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(ErrorRows $other): bool
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
