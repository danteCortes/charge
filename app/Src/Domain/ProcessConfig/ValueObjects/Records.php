<?php

namespace App\Src\Domain\ProcessConfig\ValueObjects;

use InvalidArgumentException;

final class Records
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
            throw new InvalidArgumentException('Los registros no debes ser menores que cero.');
        }
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(Records $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return '{
            "records": "'.$this->value.'"
        }';
    }
}
