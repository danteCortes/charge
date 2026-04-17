<?php

namespace App\Src\Infrastructure\LoadType\Http\Controllers;

use App\Src\Infrastructure\LoadType\Http\Services\LoadTypeService;
use Illuminate\Http\JsonResponse;

class LoadTypeController
{
    public function __construct(
        private readonly LoadTypeService $service,
    ) {}

    public function index(): JsonResponse
    {
        return $this->service->index($request);
    }
}
