<?php

namespace App\Src\Infrastructure\ProcessConfig\Http\Services;

use App\Src\Application\ProcessConfig\DTOs\ListProcessDTO;
use App\Src\Application\ProcessConfig\DTOs\ProcessConfigDTO;
use App\Src\Application\ProcessConfig\UseCases\GetFilesByProcessConfigUseCase;
use App\Src\Application\ProcessConfig\UseCases\ListProcessUseCase;
use App\Src\Application\ProcessConfig\UseCases\SaveProcessConfigUseCase;
use App\Src\Application\ProcessConfig\UseCases\ShowProcessConfigUseCase;
use App\Src\Application\ProcessConfig\UseCases\UpdateProcessConfigUseCase;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProcessConfigService
{
    public function __construct(
        private readonly SaveProcessConfigUseCase $saveUseCase,
        private readonly ShowProcessConfigUseCase $showUseCase,
        private readonly UpdateProcessConfigUseCase $updateUseCase,
        private readonly GetFilesByProcessConfigUseCase $getFilesUseCase,
        private readonly ListProcessUseCase $listProcessUseCase,
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

    public function list(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('perPage', 10);
        $search = $request->input('search', null);

        $response = $this->listProcessUseCase->execute(ListProcessDTO::create(
            $page,
            $perPage,
            $search
        ));

        return response()->json($response);
    }
}
