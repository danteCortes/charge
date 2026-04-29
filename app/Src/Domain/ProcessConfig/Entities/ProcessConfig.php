<?php

namespace App\Src\Domain\ProcessConfig\Entities;

use App\Src\Domain\ProcessConfig\Enums\Status;
use App\Src\Domain\ProcessConfig\ValueObjects\CompanyId;
use App\Src\Domain\ProcessConfig\ValueObjects\LayoutId;
use App\Src\Domain\ProcessConfig\ValueObjects\LoadTypeId;
use App\Src\Domain\ProcessConfig\ValueObjects\ProcessConfigId;
use App\Src\Domain\ProcessConfig\ValueObjects\Records;
use App\Src\Domain\ProcessConfig\ValueObjects\Responsible;
use App\Src\Domain\ProcessConfig\ValueObjects\StartDate;
use App\Src\Domain\ProcessConfig\ValueObjects\TemplateName;

class ProcessConfig
{
    private function __construct(
        private readonly ?ProcessConfigId $id,
        private readonly ?CompanyId $company,
        private readonly ?LoadTypeId $loadType,
        private readonly ?LayoutId $layout,
        private readonly ?Responsible $responsible,
        private readonly ?TemplateName $templateName,
        private readonly ?StartDate $startDate,
        private readonly Records $records,
        private readonly Status $status,
    ) {}

    public static function create(
        ?ProcessConfigId $id,
        ?CompanyId $company,
        ?LoadTypeId $loadType,
        ?LayoutId $layout,
        ?Responsible $responsible,
        ?TemplateName $templateName,
        ?StartDate $startDate,
        Records $records,
        Status $status,
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

    public function id(): ?ProcessConfigId
    {
        return $this->id;
    }

    public function company(): ?CompanyId
    {
        return $this->company;
    }

    public function loadType(): ?LoadTypeId
    {
        return $this->loadType;
    }

    public function layout(): ?LayoutId
    {
        return $this->layout;
    }

    public function responsible(): ?Responsible
    {
        return $this->responsible;
    }

    public function templateName(): ?TemplateName
    {
        return $this->templateName;
    }

    public function startDate(): ?StartDate
    {
        return $this->startDate;
    }

    public function records(): Records
    {
        return $this->records;
    }

    public function status(): Status
    {
        return $this->status;
    }
}
