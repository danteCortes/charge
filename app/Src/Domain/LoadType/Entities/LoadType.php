<?php

namespace App\Src\Domain\LoadType\Entities;

use App\Src\Domain\LoadType\ValueObjects\LoadTypeId;
use App\Src\Domain\LoadType\ValueObjects\Name;

class LoadType
{
    private function __construct(
        private readonly ?LoadTypeId $id,
        private readonly Name $name,
    ) {}

    public static function create(
        ?LoadTypeId $id,
        Name $name,
    ): self {
        return new self(
            $id,
            $name
        );
    }

    public function id(): ?LoadTypeId
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }
}
