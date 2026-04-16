<?php

namespace App\Src\Domain\Enums;

use InvalidArgumentException;

enum FileFormat: string
{
    case CSV = 'CSV';
    case TXT = 'TXT';
    case XLSX = 'XLSX';
    case XML = 'XML';
    case JSON = 'JSON';

    public function isSpreadsheet(): bool
    {
        return $this === self::XLSX;
    }

    public function isDelimited(): bool
    {
        return in_array($this, [self::CSV, self::TXT]);
    }

    public static function fromString(string $value): self
    {
        return match (strtoupper($value)) {
            'CSV' => self::CSV,
            'TXT' => self::TXT,
            'XLSX' => self::XLSX,
            'XML' => self::XML,
            'JSON' => self::JSON,
            default => throw new InvalidArgumentException(
                "Invalid decimal separator: {$value}. ".
                'Allowed values: CSV, TXT, XLSX, XML, JSON'
            )
        };
    }
}
