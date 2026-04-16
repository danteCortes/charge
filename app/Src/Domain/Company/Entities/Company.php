<?php

namespace App\Src\Domain\Company\Entities;

use App\Src\Domain\Company\ValueObjects\CompanyId;
use App\Src\Domain\Company\ValueObjects\Name;

class Company
{
    private function __construct(
        private readonly ?CompanyId $id,
        private readonly Name $name,
    ) {}

    public static function create(
        ?CompanyId $id,
        Name $name
    ): self {
        return new self(
            $id,
            $name
        );
    }

    public function id(): ?CompanyId
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }
}
