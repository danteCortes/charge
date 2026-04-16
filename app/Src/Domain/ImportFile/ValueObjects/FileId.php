<?php

namespace App\Src\Domain\ImportFile\ValueObjects;

final class FileId
{
    private function __construct(private readonly string $value) {}

    public static function create(string $value): self
    {
        if ($value <= 0) {
            throw new InvalidArgumentException('El ID del archivo debe ser mayor a cero.');
        }

        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equal(FileId $other): bool
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
