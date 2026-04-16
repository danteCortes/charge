<?php

namespace App\Src\Application\ProcessConfig\DTOs;

final class ProcessConfigDTO
{
    private function __construct(
        public readonly ?string $company,
        public readonly ?string $loadType,
        public readonly ?string $processType,
        public readonly ?string $layout,
        public readonly ?string $responsible,
    ) {}

    public static function create(
        ?string $company,
        ?string $loadType,
        ?string $processType,
        ?string $layout,
        ?string $responsible,
    ): self {
        return new self(
            $company,
            $loadType,
            $processType,
            $layout,
            $responsible,
        );
    }
}
