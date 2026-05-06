<?php

namespace App\Src\Domain\Country\Factories;

use App\Src\Domain\Country\Entities\Country;
use App\Src\Domain\Country\ValueObjects\Alpha2;
use App\Src\Domain\Country\ValueObjects\Alpha3;
use App\Src\Domain\Country\ValueObjects\CountryId;
use App\Src\Domain\Country\ValueObjects\Name;

class CountryFactory
{
    public static function fromPrimitives(
        ?string $id,
        string $name,
        string $alpha2,
        string $alpha3,
    ): Country {
        return Country::create(
            $id ? CountryId::create($id) : null,
            Name::create($name),
            Alpha2::create($alpha2),
            Alpha3::create($alpha3),
        );
    }
}
