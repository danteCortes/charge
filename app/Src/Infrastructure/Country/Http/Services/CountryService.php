<?php

namespace App\Src\Infrastructure\Country\Http\Services;

use App\Src\Application\Country\UseCases\GetCompaniesByCountryIdUseCase;
use App\Src\Application\Country\UseCases\ListCountriesUseCase;
use Illuminate\Http\JsonResponse;

class CountryService
{
    public function __construct(
        private readonly ListCountriesUseCase $listCountriesUseCase,
        private readonly GetCompaniesByCountryIdUseCase $getCompaniesByCountryIdUseCase,
    ) {}

    public function list(): JsonResponse
    {
        $response = $this->listCountriesUseCase->execute();

        return response()->json($response);
    }

    public function companies(string $id): JsonResponse
    {
        $response = $this->getCompaniesByCountryIdUseCase->execute($id);

        return response()->json($response);
    }
}
