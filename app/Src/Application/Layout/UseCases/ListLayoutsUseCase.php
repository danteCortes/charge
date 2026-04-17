<?php

namespace App\Src\Application\Layout\UseCases;

use App\Src\Application\Layout\Responses\LayoutResponse;
use App\Src\Application\Layout\Responses\ListLayoutsResponse;
use App\Src\Domain\Layout\Repositories\LayoutRepository;

class ListLayoutsUseCase
{
    private function __construct(
        private readonly LayoutRepository $repository,
    ) {}

    public static function create(LayoutRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(): ListLayoutsResponse
    {
        $layouts = $this->repository->list();

        $response = [];
        foreach ($layouts as $layout) {
            $response[] = LayoutResponse::create(
                $layout->id()?->value(),
                $layout->name()->value()
            );
        }

        return ListLayoutsResponse::create($response);
    }
}
