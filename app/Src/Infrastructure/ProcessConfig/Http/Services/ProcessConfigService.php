<?php

namespace App\Src\Infrastructure\ProcessConfig\Http\Services;

use App\Src\Application\ProcessConfig\DTOs\ProcessConfigDTO;
use App\Src\Application\ProcessConfig\UseCases\GetFilesByProcessConfigUseCase;
use App\Src\Application\ProcessConfig\UseCases\SaveProcessConfigUseCase;
use App\Src\Application\ProcessConfig\UseCases\ShowProcessConfigUseCase;
use App\Src\Application\ProcessConfig\UseCases\UpdateProcessConfigUseCase;
use App\Src\Infrastructure\ProcessConfig\Http\Requests\CreateProcessConfigRequest;
use App\Src\Infrastructure\ProcessConfig\Http\Requests\UpdateProcessConfigRequest;
use Illuminate\Http\JsonResponse;

class ProcessConfigService
{
    public function __construct(
        private readonly SaveProcessConfigUseCase $saveUseCase,
        private readonly ShowProcessConfigUseCase $showUseCase,
        private readonly UpdateProcessConfigUseCase $updateUseCase,
        private readonly GetFilesByProcessConfigUseCase $getFilesUseCase,
    ) {}

    public function store(CreateProcessConfigRequest $request): JsonResponse
    {
        $response = $this->saveUseCase->execute(
            ProcessConfigDTO::create(
                $request->input('company', ''),
                $request->input('load_type', ''),
                $request->input('process_type', ''),
                $request->input('layout', ''),
                $request->input('responsible', ''),
            )
        );

        return response()->json($response, 201);
    }

    public function show(string $id): JsonResponse
    {
        $response = $this->showUseCase->execute($id);

        return response()->json($response);
    }

    public function update(UpdateProcessConfigRequest $request, string $id): JsonResponse
    {
        $response = $this->updateUseCase->execute(
            ProcessConfigDTO::create(
                $request->input('company'),
                $request->input('load_type'),
                $request->input('process_type'),
                $request->input('layout'),
                $request->input('responsible'),
            ),
            $id
        );

        return response()->json($response, 201);
    }

    public function files(string $id): JsonResponse
    {
        $response = $this->getFilesUseCase->execute($id);

        return response()->json($response);
    }
}
