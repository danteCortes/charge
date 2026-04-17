<?php

namespace App\Src\Domain\Layout\ValueObjects;

use InvalidArgumentException;

final class LayoutId
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
            throw new InvalidArgumentException('El ID de la interfaz no debe estar vacío.');
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(LayoutId $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return '{
            "id": "'.$this->value.'"
        }';
    }
}
