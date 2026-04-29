<?php

namespace App\Src\Domain\ProcessConfig\Factories;

use App\Src\Domain\ProcessConfig\Entities\ProcessConfig;
use App\Src\Domain\ProcessConfig\Enums\Status;
use App\Src\Domain\ProcessConfig\ValueObjects\CompanyId;
use App\Src\Domain\ProcessConfig\ValueObjects\LayoutId;
use App\Src\Domain\ProcessConfig\ValueObjects\LoadTypeId;
use App\Src\Domain\ProcessConfig\ValueObjects\ProcessConfigId;
use App\Src\Domain\ProcessConfig\ValueObjects\Records;
use App\Src\Domain\ProcessConfig\ValueObjects\Responsible;
use App\Src\Domain\ProcessConfig\ValueObjects\StartDate;
use App\Src\Domain\ProcessConfig\ValueObjects\TemplateName;

class ProcessConfigFactory
{
    public static function fromPrimitives(
        ?string $id,
        ?string $company,
        ?string $loadType,
        ?string $layout,
        ?string $responsible,
        ?string $templateName,
        ?string $startDate,
        int $records,
        string $status,
    ): ProcessConfig {
        return ProcessConfig::create(
            $id ? ProcessConfigId::create($id) : null,
            $company ? CompanyId::create($company) : null,
            $loadType ? LoadTypeId::create($loadType) : null,
            $layout ? LayoutId::create($layout) : null,
            $responsible ? Responsible::create($responsible) : null,
            $templateName ? TemplateName::create($templateName) : null,
            $startDate ? StartDate::create($startDate) : null,
            Records::create($records),
            Status::fromString($status),
        );
    }
}
