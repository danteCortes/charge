<?php

namespace App\Src\Domain\ProcessConfig\Entities;

use App\Src\Domain\ProcessConfig\Enums\ProcessType;
use App\Src\Domain\ProcessConfig\ValueObjects\CompanyId;
use App\Src\Domain\ProcessConfig\ValueObjects\LayoutId;
use App\Src\Domain\ProcessConfig\ValueObjects\LoadTypeId;
use App\Src\Domain\ProcessConfig\ValueObjects\ProcessConfigId;
use App\Src\Domain\ProcessConfig\ValueObjects\Responsible;

class ProcessConfig
{
    private function __construct(
        private readonly ?ProcessConfigId $id,
        private readonly ?CompanyId $company,
        private readonly ?LoadTypeId $loadType,
        private readonly ?ProcessType $processType,
        private readonly ?LayoutId $layout,
        private readonly ?Responsible $responsible,
    ) {}

    public static function create(
        ?ProcessConfigId $id,
        ?CompanyId $company,
        ?LoadTypeId $loadType,
        ?ProcessType $processType,
        ?LayoutId $layout,
        ?Responsible $responsible,
    ): self {
        return new self(
            $id,
            $company,
            $loadType,
            $processType,
            $layout,
            $responsible,
            $processConfigId,
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

    public function processType(): ?ProcessType
    {
        return $this->processType;
    }

    public function layout(): ?LayoutId
    {
        return $this->layout;
    }

    public function responsible(): ?Responsible
    {
        return $this->responsible;
    }
}
