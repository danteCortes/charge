<?php

namespace App\Src\Domain\ProcessConfig\Factories;

use App\Src\Domain\ProcessConfig\Entities\ProcessConfig;
use App\Src\Domain\ProcessConfig\Enums\ProcessType;
use App\Src\Domain\ProcessConfig\Enums\Status;
use App\Src\Domain\ProcessConfig\ValueObjects\CompanyId;
use App\Src\Domain\ProcessConfig\ValueObjects\LayoutId;
use App\Src\Domain\ProcessConfig\ValueObjects\ProcessConfigId;
use App\Src\Domain\ProcessConfig\ValueObjects\Records;
use App\Src\Domain\ProcessConfig\ValueObjects\Responsible;
use App\Src\Domain\ProcessConfig\ValueObjects\StartDate;
use App\Src\Domain\ProcessConfig\ValueObjects\TemplateName;

class ProcessConfigFactory
{
    public static function fromPrimitives(
        ?string $id,
        string $company,
        string $layout,
        string $processType,
        string $responsible,
        ?string $templateName,
        ?string $startDate,
        int $records,
        string $status,
    ): ProcessConfig {
        return ProcessConfig::create(
            $id ? ProcessConfigId::create($id) : null,
            CompanyId::create($company),
            LayoutId::create($layout),
            ProcessType::fromString($processType),
            Responsible::create($responsible),
            $templateName ? TemplateName::create($templateName) : null,
            $startDate ? StartDate::create($startDate) : null,
            Records::create($records),
            Status::fromString($status),
        );
    }
}
