<?php

namespace App\Src\Domain\ValueObjects;

final class FileSize {

    private const MAX_BYTES = 500 * 1024 * 1024;

    private function __construct(private readonly int $value){}

    public static function create(int $value): self
    {
        if($value <= 0){
            throw new InvalidArgumentException("El tamaño del archivo debe ser mayor a cero.");
        }
        if($value > self::MAX_BYTES){
            throw new InvalidArgumentException("El tamaño del archivo debe ser menor a " . self::MAX_BYTES . ".");
        }
        return new self($value);
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equal(FileSize $other): bool
    {
        return $this->value === $other->value;
    }

    public function toString(): string {
        return '{
            "file_size": "' . $this->value . '"
        }';
    }
}