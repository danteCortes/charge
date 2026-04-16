<?php

namespace App\Src\Domain\ProcessConfig\ValueObjects;

use InvalidArgumentException;

final class CompanyId
{
    private function __construct(private readonly string $value) {}

    public static function create(string $value): self
    {
        if (trim($value) === '') {
            throw new InvalidArgumentException('la empresa no debe estar vacío.');
        }

        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return '{
            "company": "'.$this->value.'"
        }';
    }
}
