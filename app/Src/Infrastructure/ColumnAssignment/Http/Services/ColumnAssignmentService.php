<?php

namespace App\Src\Infrastructure\ColumnAssignment\Http\Services;

use App\Src\Application\ColumnAssignment\DTOs\ColumnAssignmentDTO;
use App\Src\Application\ColumnAssignment\UseCases\SaveColumnAssignmentUseCase;
use App\Src\Application\ColumnAssignment\UseCases\UpdateColumnAssignmentUseCase;
use App\Src\Infrastructure\ColumnAssignment\Http\Requests\StoreColumnAssignmentRequest;
use App\Src\Infrastructure\ColumnAssignment\Http\Requests\UpdateColumnAssignmentRequest;
use Illuminate\Http\JsonResponse;

class ColumnAssignmentService
{
    public function __construct(
        private readonly SaveColumnAssignmentUseCase $createUseCase,
        private readonly UpdateColumnAssignmentUseCase $updateUseCase,
    ) {}

    public function store(StoreColumnAssignmentRequest $request): JsonResponse
    {
        $response = $this->createUseCase->execute(ColumnAssignmentDTO::create(
            $request->import_file_id,
            $request->column_name,
            $request->system_field_id,
        ));

        return response()->json($response, 201);
    }

    public function update(UpdateColumnAssignmentRequest $request, string $id): JsonResponse
    {
        $response = $this->updateUseCase->execute(ColumnAssignmentDTO::create(
            $request->import_file_id,
            $request->column_name,
            $request->system_field_id,
        ), $id);

        return response()->json($response);
    }
}
