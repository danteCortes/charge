<?php

namespace App\Src\Infrastructure\Layout\Http\Controllers;

use App\Src\Infrastructure\Layout\Http\Services\LayoutService;
use Illuminate\Http\JsonResponse;

class LayoutController
{
    public function __construct(
        private readonly LayoutService $service,
    ) {}

    public function index(): JsonResponse
    {
        return $this->service->index();
    }
}
