<?php

namespace App\Src\Infrastructure\Layout\Http\Services;

use App\Src\Application\Layout\UseCases\ListLayoutsUseCase;
use Illuminate\Http\JsonResponse;

class LayoutService
{
    public function __construct(
        private readonly ListLayoutsUseCase $listUseCase,
    ) {}

    public function index(): JsonResponse
    {
        $response = $this->listUseCase->execute();

        return response()->json($response);
    }
}
