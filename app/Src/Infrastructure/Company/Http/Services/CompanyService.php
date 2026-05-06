<?php

namespace App\Src\Infrastructure\Company\Http\Services;

use App\Src\Application\Company\UseCases\GetCompaniesByCountryIdUseCase;
use App\Src\Application\Company\UseCases\ListCompaniesUseCase;
use Illuminate\Http\JsonResponse;

class CompanyService
{
    public function __construct(
        private readonly ListCompaniesUseCase $listUseCase,
        private readonly GetCompaniesByCountryIdUseCase $getCompaniesByCountryIdUseCase,
    ) {}

    public function index(): JsonResponse
    {
        $response = $this->listUseCase->execute();

        return response()->json($response);
    }

    public function getCompaniesByCountryId(string $country_id): JsonResponse
    {
        $response = $this->getCompaniesByCountryIdUseCase->execute($country_id);

        return response()->json($response);
    }
}
