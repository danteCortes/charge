<?php

namespace App\Src\Infrastructure\Company\Http\Controllers;

use App\Src\Infrastructure\Company\Http\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController
{
    public function __construct(
        private readonly CompanyService $service,
    ) {}

    public function index(): JsonResponse
    {
        return $this->service->index();
    }

    public function getCompaniesByCountryId(Request $request): JsonResponse
    {
        $country_id = $request->input('country_id', null);
        if (! $country_id) {
            return response()->json(['errors' => ['country_id' => ['El id del país es obligatorio.']]], 422);
        }

        return $this->service->getCompaniesByCountryId($country_id);
    }
}
