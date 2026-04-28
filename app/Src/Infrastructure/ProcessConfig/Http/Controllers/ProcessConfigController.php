<?php

namespace App\Src\Infrastructure\ProcessConfig\Http\Controllers;

use App\Src\Infrastructure\ProcessConfig\Http\Requests\CreateProcessConfigRequest;
use App\Src\Infrastructure\ProcessConfig\Http\Requests\UpdateProcessConfigRequest;
use App\Src\Infrastructure\ProcessConfig\Http\Services\ProcessConfigService;
use Illuminate\Http\JsonResponse;

class ProcessConfigController
{
    public function __construct(
        private readonly ProcessConfigService $service,
    ) {}

    public function store(CreateProcessConfigRequest $request): JsonResponse
    {
        return $this->service->store($request->toDTO());
    }

    public function show(string $id): JsonResponse
    {
        return $this->service->show($id);
    }

    public function update(UpdateProcessConfigRequest $request, string $id): JsonResponse
    {
        return $this->service->update($request, $id);
    }

    public function files(string $id): JsonResponse
    {
        return $this->service->files($id);
    }
}
