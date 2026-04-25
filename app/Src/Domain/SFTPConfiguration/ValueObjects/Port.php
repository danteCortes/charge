<?php

namespace App\Src\Domain\SFTPConfiguration\ValueObjects;

use InvalidArgumentException;

final class Port
{
    private function __construct(private readonly int $value){}

    public static function create(int $value): self {
        self::validate($value);
        return new self($value);
    }

    private static function validate(int $value): void
    {
        if ($value >= 0 && $value <= 65535) {
            throw new InvalidArgumentException('El puerto debe estar entre el 0 y 65535.');
        }
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(Port $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return '{
            "port": "' . $this->value . '"
        }';
    }
}
