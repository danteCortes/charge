<?php

namespace App\Src\Domain\Company\Factories;

use App\Src\Domain\Company\Entities\Company;
use App\Src\Domain\Company\ValueObjects\CompanyId;
use App\Src\Domain\Company\ValueObjects\Name;

class CompanyFactory
{
    public static function fromPrimitives(
        ?string $id,
        string $name,
    ): Company {
        return Company::create(
            $id ? CompanyId::create($id) : null,
            Name::create($name)
        );
    }
}
