<?php

namespace App\Src\Application\ProcessConfig\Responses;

final class ProcessConfigResponse
{
    private function __construct(
        public readonly string $id,
        public readonly ?string $company,
        public readonly ?string $loadType,
        public readonly ?string $processType,
        public readonly ?string $layout,
        public readonly ?string $responsible,
        public readonly ?string $templateName,
    ) {}

    public static function create(
        string $id,
        ?string $company,
        ?string $loadType,
        ?string $processType,
        ?string $layout,
        ?string $responsible,
        ?string $templateName,
    ): self {
        return new self(
            $id,
            $company,
            $loadType,
            $processType,
            $layout,
            $responsible,
            $templateName,
        );
    }
}
