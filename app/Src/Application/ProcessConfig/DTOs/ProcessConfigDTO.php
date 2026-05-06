<?php

namespace App\Src\Application\ProcessConfig\DTOs;

final class ProcessConfigDTO
{
    private function __construct(
        public readonly ?string $company,
        public readonly ?string $layout,
        public readonly ?string $processType,
        public readonly ?string $responsible,
        public readonly ?string $templateName,
    ) {}

    public static function create(
        ?string $company,
        ?string $layout,
        ?string $processType,
        ?string $responsible,
        ?string $templateName,
    ): self {
        return new self(
            $company,
            $layout,
            $processType,
            $responsible,
            $templateName,
        );
    }
}
