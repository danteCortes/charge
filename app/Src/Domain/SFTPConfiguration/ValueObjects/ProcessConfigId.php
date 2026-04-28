<?php

namespace App\Src\Domain\SFTPConfiguration\ValueObjects;

use InvalidArgumentException;

final class ProcessConfigId
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
            throw new InvalidArgumentException('El id del proceso no debe estar vacío.');
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(ProcessConfigId $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return '{
            "process_config_id": "'.$this->value.'"
        }';
    }
}
