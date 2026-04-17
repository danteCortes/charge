<?php

namespace App\Src\Application\SystemField\UseCases;

use App\Src\Application\SystemField\Responses\ListSystemFieldsResponse;
use App\Src\Application\SystemField\Responses\SystemFieldResponse;
use App\Src\Domain\SystemField\Repositories\SystemFieldRepository;

class ListSystemFieldsUseCase
{
    private function __construct(
        private readonly SystemFieldRepository $repository,
    ) {}

    public static function create(SystemFieldRepository $repository): self
    {
        return new self($repository);
    }

    public function execute(): ListSystemFieldsResponse
    {
        $systemFields = $this->repository->list();

        $systemFieldResponses = [];
        foreach ($systemFields as $systemField) {
            $systemFieldResponses[] = SystemFieldResponse::create(
                $systemField->id()?->value(),
                $systemField->name()->value(),
                $systemField->description()?->value(),
                $systemField->isRequired()
            );
        }

        return ListSystemFieldsResponse::create($systemFieldResponses);
    }
}
