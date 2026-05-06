<?php

namespace App\Src\Application\Country\Responses;

final class ListCountriesResponse
{
    /**
     * @param App\Src\Application\Country\Responses\CountryResponse[]
     */
    private function __construct(
        public readonly array $countries
    ) {}

    public static function create(
        array $countries
    ): self {
        return new self(
            $countries
        );
    }
}
