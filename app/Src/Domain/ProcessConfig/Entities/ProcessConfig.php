<?php

namespace App\Src\Domain\ProcessConfig\Entities;

use App\Src\Domain\ProcessConfig\Enums\ProcessType;
use App\Src\Domain\ProcessConfig\Enums\Status;
use App\Src\Domain\ProcessConfig\ValueObjects\CompanyId;
use App\Src\Domain\ProcessConfig\ValueObjects\LayoutId;
use App\Src\Domain\ProcessConfig\ValueObjects\ProcessConfigId;
use App\Src\Domain\ProcessConfig\ValueObjects\Records;
use App\Src\Domain\ProcessConfig\ValueObjects\Responsible;
use App\Src\Domain\ProcessConfig\ValueObjects\StartDate;
use App\Src\Domain\ProcessConfig\ValueObjects\TemplateName;

class ProcessConfig
{
    private function __construct(
        private readonly ?ProcessConfigId $id,
        private readonly CompanyId $company,
        private readonly LayoutId $layout,
        private readonly ProcessType $processType,
        private readonly Responsible $responsible,
        private readonly ?TemplateName $templateName,
        private readonly ?StartDate $startDate,
        private readonly Records $records,
        private readonly Status $status,
    ) {}

    public static function create(
        ?ProcessConfigId $id,
        CompanyId $company,
        LayoutId $layout,
        ProcessType $processType,
        Responsible $responsible,
        ?TemplateName $templateName,
        ?StartDate $startDate,
        Records $records,
        Status $status,
    ): self {
        return new self(
            $id,
            $company,
            $layout,
            $processType,
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

    public function company(): CompanyId
    {
        return $this->company;
    }

    public function layout(): LayoutId
    {
        return $this->layout;
    }

    public function processType(): ProcessType
    {
        return $this->processType;
    }

    public function responsible(): Responsible
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
