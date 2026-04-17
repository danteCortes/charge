<?php

namespace App\Src\Application\LoadType\Responses;

final class LoadTypeResponse
{
    private function __construct(
        public readonly string $id,
        public readonly string $name,
    ) {}

    public static function create(
        string $id,
        string $name,
    ): self {
        return new self(
            $id,
            $name
        );
    }
}
