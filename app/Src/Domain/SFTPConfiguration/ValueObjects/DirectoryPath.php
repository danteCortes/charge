<?php

namespace App\Src\Domain\SFTPConfiguration\ValueObjects;

use InvalidArgumentException;

final class DirectoryPath
{
    private function __construct(private readonly string $value){}

    public static function create(string $value): self {
        self::validate($value);
        return new self($value);
    }

    private static function validate(string $value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException('La ruta de la carpeta no debe estar vacío.');
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(DirectoryPath $other): bool
    {
        return $this->value === $other->value;
    }

    public function __toString(): string
    {
        return '{
            "directory_path": "' . $this->value . '"
        }';
    }
}
