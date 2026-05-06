<?php

namespace App\Src\Application\ProcessConfig\Responses;

final class ProcessConfigResponse
{
    private function __construct(
        public readonly string $id,
        public readonly string $company,
        public readonly string $layout,
        public readonly string $process_type,
        public readonly string $responsible,
        public readonly ?string $template_name,
        public readonly ?string $start_date,
        public readonly int $records,
        public readonly string $status,
    ) {}

    public static function create(
        string $id,
        string $company,
        string $layout,
        string $process_type,
        string $responsible,
        ?string $template_name,
        ?string $start_date,
        int $records,
        string $status,
    ): self {
        return new self(
            $id,
            $company,
            $layout,
            $process_type,
            $responsible,
            $template_name,
            $start_date,
            $records,
            $status,
        );
    }
}
