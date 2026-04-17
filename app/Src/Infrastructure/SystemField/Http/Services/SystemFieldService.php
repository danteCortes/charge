<?php

namespace App\Src\Infrastructure\SystemField\Http\Services;

use App\Src\Application\SystemField\UseCases\ListSystemFieldsUseCase;
use Illuminate\Http\JsonResponse;

class SystemFieldService
{
    public function __construct(
        private readonly ListSystemFieldsUseCase $listUseCase,
    ) {}

    public function index(): JsonResponse
    {
        $response = $this->listUseCase->execute();

        return response()->json($response);
    }
}
