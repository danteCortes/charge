<?php

namespace App\Src\Application\ProcessConfig\Responses;

final class ProcessConfigResponse
{
    private function __construct(
        public readonly string $id,
        public readonly ?string $company,
        public readonly ?string $loadType,
        public readonly ?string $layout,
        public readonly ?string $responsible,
        public readonly ?string $templateName,
        public readonly ?string $startDate,
        public readonly int $records,
        public readonly string $status,
    ) {}

    public static function create(
        string $id,
        ?string $company,
        ?string $loadType,
        ?string $layout,
        ?string $responsible,
        ?string $templateName,
        ?string $startDate,
        int $records,
        string $status,
    ): self {
        return new self(
            $id,
            $company,
            $loadType,
            $layout,
            $responsible,
            $templateName,
            $startDate,
            $records,
            $status,
        );
    }
}
