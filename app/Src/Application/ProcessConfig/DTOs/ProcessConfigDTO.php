<?php

namespace App\Src\Application\ProcessConfig\DTOs;

final class ProcessConfigDTO
{
    private function __construct(
        public readonly ?string $company,
        public readonly ?string $loadType,
        public readonly ?string $layout,
        public readonly ?string $responsible,
        public readonly ?string $templateName,
    ) {}

    public static function create(
        ?string $company,
        ?string $loadType,
        ?string $layout,
        ?string $responsible,
        ?string $templateName,
    ): self {
        return new self(
            $company,
            $loadType,
            $layout,
            $responsible,
            $templateName,
        );
    }
}
