<?php

namespace App\Src\Infrastructure\Country\Http\Controllers;

use App\Src\Infrastructure\Country\Http\Services\CountryService;
use Illuminate\Http\JsonResponse;

class CountryController
{
    public function __construct(
        private readonly CountryService $service,
    ) {}

    public function list(): JsonResponse
    {
        return $this->service->list();
    }

    public function companies(string $id): JsonResponse
    {
        return $this->service->companies($id);
    }
}
