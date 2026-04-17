<?php

namespace App\Src\Domain\Layout\Entities;

use App\Src\Domain\Layout\ValueObjects\LayoutId;
use App\Src\Domain\Layout\ValueObjects\Name;

class Layout
{
    private function __construct(
        private readonly ?LayoutId $id,
        private readonly Name $name,
    ) {}

    public static function create(
        ?LayoutId $id,
        Name $name,
    ): self {
        return new self(
            $id,
            $name
        );
    }

    public function id(): ?LayoutId
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }
}
