<?php

namespace App\Src\Domain\ValueObjects;

final class FileId {

    private function __construct(private readonly int $value){}

    public static function create(int $value): self
    {
        if($value <= 0){
            throw new InvalidArgumentException("El ID del archivo debe ser mayor a cero.");
        }
        return new self($value);
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equal(FileId $other): bool
    {
        return $this->value === $other->value;
    }

    public function toString(): string {
        return '{
            "file_id": "' . $this->value . '"
        }';
    }
}