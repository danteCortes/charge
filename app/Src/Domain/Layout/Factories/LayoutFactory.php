<?php

namespace App\Src\Domain\Layout\Factories;

use App\Src\Domain\Layout\Entities\Layout;
use App\Src\Domain\Layout\ValueObjects\LayoutId;
use App\Src\Domain\Layout\ValueObjects\Name;

class LayoutFactory
{
    public static function fromPrimitives(
        ?string $id,
        string $name
    ): Layout {
        return Layout::create(
            $id ? LayoutId::create($id) : null,
            Name::create($name)
        );
    }
}
