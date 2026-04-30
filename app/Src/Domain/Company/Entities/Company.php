<?php

namespace App\Src\Domain\Company\Entities;

use App\Src\Domain\Company\Enums\Status;
use App\Src\Domain\Company\ValueObjects\Code;
use App\Src\Domain\Company\ValueObjects\CompanyId;
use App\Src\Domain\Company\ValueObjects\CountryId;
use App\Src\Domain\Company\ValueObjects\Name;
use App\Src\Domain\Company\ValueObjects\Responsible;

class Company
{
    private function __construct(
        private readonly ?CompanyId $id,
        private readonly CountryId $countryId,
        private readonly Code $code,
        private readonly Name $name,
        private readonly Responsible $responsible,
        private readonly Status $status,
    ) {}

    public static function create(
        ?CompanyId $id,
        CountryId $countryId,
        Code $code,
        Name $name,
        Responsible $responsible,
        Status $status,
    ): self {
        return new self(
            $id,
            $countryId,
            $code,
            $name,
            $responsible,
            $status,
        );
    }

    public function id(): ?CompanyId
    {
        return $this->id;
    }

    public function countryId(): CountryId
    {
        return $this->countryId;
    }

    public function code(): Code
    {
        return $this->code;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function responsible(): Responsible
    {
        return $this->responsible;
    }

    public function status(): Status
    {
        return $this->status;
    }
}
