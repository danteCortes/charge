<?php

namespace App\Src\Infrastructure\SystemField\Http\Controllers;

use App\Src\Infrastructure\SystemField\Http\Services\SystemFieldService;
use Illuminate\Http\JsonResponse;

class SystemFieldController
{
    public function __construct(
        private readonly SystemFieldService $service,
    ) {}

    public function index(): JsonResponse
    {
        return $this->service->index();
    }
}
