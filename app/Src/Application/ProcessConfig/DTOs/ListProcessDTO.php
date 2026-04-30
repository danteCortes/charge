<?php

namespace App\Src\Application\ProcessConfig\DTOs;

final class ListProcessDTO
{
    private function __construct(
        public readonly int $page,
        public readonly int $perPage,
        public readonly ?string $search,
    ) {}

    public static function create(
        int $page,
        int $perPage,
        ?string $search,
    ): self {
        return new self(
            $page,
            $perPage,
            $search,
        );
    }
}
