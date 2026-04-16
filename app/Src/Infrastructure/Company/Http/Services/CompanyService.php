<?php

namespace App\Src\Infrastructure\Company\Http\Services;

use App\Src\Application\Company\UseCases\ListCompaniesUseCase;
use Illuminate\Http\JsonResponse;

class CompanyService
{
    public function __construct(
        private readonly ListCompaniesUseCase $listUseCase,
    ) {}

    public function index(): JsonResponse
    {
        $response = $this->listUseCase->execute();

        return response()->json($response);
    }
}
