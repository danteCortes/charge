<?php

namespace App\Src\Application\Country\Responses;

final class CountryResponse
{
    private function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $alpha2,
        public readonly string $alpha3,
    ) {}

    public static function create(
        string $id,
        string $name,
        string $alpha2,
        string $alpha3,
    ): self {
        return new self(
            $id,
            $name,
            $alpha2,
            $alpha3,
        );
    }
}
