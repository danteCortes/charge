<?php

namespace App\Src\Domain\Country\Entities;

use App\Src\Domain\Country\ValueObjects\Alpha2;
use App\Src\Domain\Country\ValueObjects\Alpha3;
use App\Src\Domain\Country\ValueObjects\CountryId;
use App\Src\Domain\Country\ValueObjects\Name;

class Country
{
    private function __construct(
        private readonly ?CountryId $id,
        private readonly Name $name,
        private readonly Alpha2 $alpha2,
        private readonly Alpha3 $alpha3,
    ) {}

    public static function create(
        ?CountryId $id,
        Name $name,
        Alpha2 $alpha2,
        Alpha3 $alpha3,
    ): self {
        return new self(
            $id,
            $name,
            $alpha2,
            $alpha3,
        );
    }

    public function id(): ?CountryId
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function alpha2(): Alpha2
    {
        return $this->alpha2;
    }

    public function alpha3(): Alpha3
    {
        return $this->alpha3;
    }
}
