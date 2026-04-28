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
        public readonly ?string $templateName,
    ) {}

    public static function create(
        ?string $company,
        ?string $loadType,
        ?string $processType,
        ?string $layout,
        ?string $responsible,
        ?string $templateName,
    ): self {
        return new self(
            $company,
            $loadType,
            $processType,
            $layout,
            $responsible,
            $templateName,
        );
    }
}
