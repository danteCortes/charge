<?php

namespace App\Src\Application\Company\Responses;

final class CompanyResponse
{
    public function __construct(
        public readonly string $id,
        public readonly string $country_id,
        public readonly string $code,
        public readonly string $name,
        public readonly string $responsible,
        public readonly bool $status,
    ) {}
}
