<?php

namespace App\Src\Application\Layout\Responses;

final class LayoutResponse
{
    private function __construct(
        public readonly ?string $id,
        public readonly string $name,
    ) {}

    public static function create(
        ?string $id,
        string $name,
    ): self {
        return new self(
            $id,
            $name
        );
    }
}
