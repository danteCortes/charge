<?php

namespace App\Src\Infrastructure\ColumnAssignment\Http\Controllers;

use App\Src\Infrastructure\ColumnAssignment\Http\Requests\StoreColumnAssignmentRequest;
use App\Src\Infrastructure\ColumnAssignment\Http\Requests\UpdateColumnAssignmentRequest;
use App\Src\Infrastructure\ColumnAssignment\Http\Services\ColumnAssignmentService;
use Illuminate\Http\JsonResponse;

class ColumnAssignmentController
{
    public function __construct(
        private readonly ColumnAssignmentService $service,
    ) {}

    public function store(StoreColumnAssignmentRequest $request): JsonResponse
    {
        return $this->service->store($request);
    }

    public function update(UpdateColumnAssignmentRequest $request, string $id): JsonResponse
    {
        return $this->service->update($request, $id);
    }
}
