<?php

namespace App\Src\Infrastructure\SFTPConfiguration\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Src\Infrastructure\SFTPConfiguration\Http\Requests\CreateSFTPConfigurationRequest;
use App\Src\Infrastructure\SFTPConfiguration\Http\Requests\UpdateSFTPConfigurationRequest;
use App\Src\Infrastructure\SFTPConfiguration\Http\Services\SFTPConfigurationService;

class SFTPConfigurationController
{
    public function __construct(
        private readonly SFTPConfigurationService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        return $this->service->index($request);
    }

    public function store(CreateSFTPConfigurationRequest $request): JsonResponse
    {
        return $this->service->store($request);
    }

    public function show(string $id): JsonResponse
    {
        return $this->service->store($id);
    }

    public function update(UpdateSFTPConfigurationRequest $request): JsonResponse
    {
        return $this->service->update($request);
    }

    public function delete(string $id): JsonResponse
    {
        return $this->service->delete($id);
    }
}
