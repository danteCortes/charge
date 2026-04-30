<?php

namespace App\Src\Domain\Company\Factories;

use App\Src\Domain\Company\Entities\Company;
use App\Src\Domain\Company\Enums\Status;
use App\Src\Domain\Company\ValueObjects\Code;
use App\Src\Domain\Company\ValueObjects\CompanyId;
use App\Src\Domain\Company\ValueObjects\CountryId;
use App\Src\Domain\Company\ValueObjects\Name;
use App\Src\Domain\Company\ValueObjects\Responsible;

class CompanyFactory
{
    public static function fromPrimitives(
        ?string $id,
        string $countryId,
        string $code,
        string $name,
        string $responsible,
        bool $status,
    ): Company {
        return Company::create(
            $id ? CompanyId::create($id) : null,
            CountryId::create($countryId),
            Code::create($code),
            Name::create($name),
            Responsible::create($responsible),
            $status ? Status::ACTIVE : Status::INACTIVE,
        );
    }
}
