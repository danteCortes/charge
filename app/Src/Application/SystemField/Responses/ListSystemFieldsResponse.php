<?php

namespace App\Src\Application\SystemField\Responses;

final class ListSystemFieldsResponse
{
    /**
     * @param  App\Src\Application\SystemField\Responses\SystemFieldResonse[]  $systemFields
     */
    private function __construct(
        public readonly array $systemFields
    ) {}

    public static function create(
        array $systemFields
    ): self {
        return new self(
            $systemFields
        );
    }
}
