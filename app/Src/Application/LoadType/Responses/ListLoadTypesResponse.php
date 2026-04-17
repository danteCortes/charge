<?php

namespace App\Src\Application\LoadType\Responses;

final class ListLoadTypesResponse
{
    /**
     * @param App\Src\Application\LoadType\Responses\LoadTypeResponse[]
     */
    private function __construct(
        public readonly array $loadTypes
    ) {}

    public static function create(
        array $loadTypes
    ): self {
        return new self(
            $loadTypes
        );
    }
}
