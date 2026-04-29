<?php

namespace App\Src\Infrastructure\ProcessConfig\Http\Services;

use App\Src\Application\ProcessConfig\DTOs\ProcessConfigDTO;
use App\Src\Application\ProcessConfig\UseCases\GetFilesByProcessConfigUseCase;
use App\Src\Application\ProcessConfig\UseCases\SaveProcessConfigUseCase;
use App\Src\Application\ProcessConfig\UseCases\ShowProcessConfigUseCase;
use App\Src\Application\ProcessConfig\UseCases\UpdateProcessConfigUseCase;
use Illuminate\Http\JsonResponse;

class ProcessConfigService
{
    public function __construct(
        private readonly SaveProcessConfigUseCase $saveUseCase,
        private readonly ShowProcessConfigUseCase $showUseCase,
        private readonly UpdateProcessConfigUseCase $updateUseCase,
        private readonly GetFilesByProcessConfigUseCase $getFilesUseCase,
    ) {}

    public function store(ProcessConfigDTO $dto): JsonResponse
    {
        $response = $this->saveUseCase->execute($dto);

        return response()->json($response, 201);
    }

    public function show(string $id): JsonResponse
    {
        $response = $this->showUseCase->execute($id);

        return response()->json($response);
    }

    public function update(ProcessConfigDTO $dto, string $id): JsonResponse
    {
        $response = $this->updateUseCase->execute($dto, $id);

        return response()->json($response);
    }

    public function files(string $id): JsonResponse
    {
        $response = $this->getFilesUseCase->execute($id);

        return response()->json($response);
    }
}
