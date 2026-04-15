<?php

namespace App\Src\Domain\ValueObjects;

final class FileName {

    private function __construct(private readonly string $value){}

    public static function create(string $value): self
    {
        if(trim($value) === ''){
            throw new InvalidArgumentException("El nombre del archivo no debe estar vacío.");
        }
        return new self($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equal(FileName $other): bool
    {
        return $this->value === $other->value;
    }

    public function toString(): string {
        return '{
            "file_name": "' . $this->value . '"
        }';
    }
}