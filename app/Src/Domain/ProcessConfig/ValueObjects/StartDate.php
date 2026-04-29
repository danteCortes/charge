<?php

namespace App\Src\Domain\ProcessConfig\ValueObjects;

use DateTimeImmutable;
use InvalidArgumentException;

final class StartDate
{
    private function __construct(private readonly DateTimeImmutable $value) {}

    public static function create(string $value): self
    {
        self::validate($value);

        return new self(new DateTimeImmutable($value));
    }

    private static function validate(string $value): void
    {
        if (empty($value)) {
            throw new InvalidArgumentException('La fecha de inicio no puede estar vacío');
        }

        try {
            new DateTimeImmutable($value);
        } catch (\Exception) {
            throw new InvalidArgumentException('Formato de fecha inválido');
        }
    }

    public function value(): DateTimeImmutable
    {
        return $this->value;
    }

    public function equals(StartDate $other): bool
    {
        return $this->value->getTimestamp() === $other->value->getTimestamp();
    }

    public function __toString(): string
    {
        return $this->format();
    }

    public function format(string $format = 'Y-m-d H:i:s'): string
    {
        return $this->value->format($format);
    }
}
