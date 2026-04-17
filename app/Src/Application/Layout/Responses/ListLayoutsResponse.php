<?php

namespace App\Src\Application\Layout\Responses;

final class ListLayoutsResponse
{
    /**
     * @param LayoutResponse[]
     */
    private function __construct(
        public readonly array $layouts
    ) {}

    public static function create(
        array $layouts
    ): self {
        return new self(
            $layouts
        );
    }
}
