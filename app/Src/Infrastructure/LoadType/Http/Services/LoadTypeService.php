<?php

namespace App\Src\Infrastructure\LoadType\Http\Services;

use App\Src\Application\LoadType\UseCases\ListLoadTypesUseCase;
use Illuminate\Http\JsonResponse;

class LoadTypeService
{
    public function __construct(
        private readonly ListLoadTypesUseCase $listUseCase,
    ) {}

    public function index(): JsonResponse
    {
        $response = $this->listUseCase->execute();

        return response()->json($response);
    }
}
