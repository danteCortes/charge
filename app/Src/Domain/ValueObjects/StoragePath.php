<?php

namespace App\Src\Domain\ValueObjects;

final class StoragePath
{
    private function __construct(private readonly string $value) {}

    public static function create(string $value): self
    {
        if (trim($value) === '') {
            throw new InvalidArgumentException('La ruta de almacenamiento del archivo no debe estar vacío.');
        }

        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equal(StoragePath $other): bool
    {
        return $this->value === $other->value;
    }

    public function toString(): string
    {
        return '{
            "storage_path": "'.$this->value.'"
        }';
    }
}
