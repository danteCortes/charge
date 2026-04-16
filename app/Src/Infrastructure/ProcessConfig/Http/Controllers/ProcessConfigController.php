<?php

namespace App\Src\Infrastructure\ProcessConfig\Http\Controllers;

use App\Src\Infrastructure\ProcessConfig\Http\Requests\CreateProcessConfigRequest;
use App\Src\Infrastructure\ProcessConfig\Http\Services\ProcessConfigService;
use Illuminate\Http\JsonResponse;

class ProcessConfigController
{
    public function __construct(
        private readonly ProcessConfigService $service,
    ) {}

    public function store(CreateProcessConfigRequest $request): JsonResponse
    {
        return $this->service->store($request);
    }

    public function show(string $id): JsonResponse
    {
        return $this->service->show($id);
    }
}
