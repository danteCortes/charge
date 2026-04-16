<?php

namespace App\Src\Infrastructure\Company\Http\Controllers;

use App\Src\Infrastructure\Company\Http\Services\CompanyService;
use Illuminate\Http\JsonResponse;

class CompanyController
{
    public function __construct(
        private readonly CompanyService $service,
    ) {}

    public function index(): JsonResponse
    {
        return $this->service->index();
    }
}
