<?php

namespace App\Src\Application\Company\Responses;

final class CompanyResponse
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
    ) {}
}
