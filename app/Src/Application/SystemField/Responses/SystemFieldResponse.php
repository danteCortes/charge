<?php

namespace App\Src\Application\SystemField\Responses;

final class SystemFieldResponse
{
    private function __construct(
        public readonly ?string $id,
        public readonly string $name,
        public readonly ?string $description,
        public readonly bool $required,
    ) {}

    public static function create(
        ?string $id,
        string $name,
        ?string $description,
        bool $required,
    ): self {
        return new self(
            $id,
            $name,
            $description,
            $required,
        );
    }
}
