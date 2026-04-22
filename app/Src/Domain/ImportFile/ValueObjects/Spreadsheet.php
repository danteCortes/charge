<?php

namespace App\Src\Domain\ImportFile\ValueObjects;

final class Spreadsheet
{
    private function __construct(private readonly string $value) {}

    public static function create(string $value): self
    {
        if (trim($value) === '') {
            throw new \InvalidArgumentException('La hoja de archivo no debe estar vacío.');
        }

        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equal(SpreadSheet $other): bool
    {
        return $this->value === $other->value;
    }

    public function toString(): string
    {
        return '{
            "file_id": "'.$this->value.'"
        }';
    }
}
