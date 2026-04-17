<?php

namespace App\Src\Domain\LoadType\Factories;

use App\Src\Domain\LoadType\Entities\LoadType;
use App\Src\Domain\LoadType\ValueObjects\LoadTypeId;
use App\Src\Domain\LoadType\ValueObjects\Name;

class LoadTypeFactory
{
    public static function fromPrimitives(
        ?string $id,
        string $name,
    ): LoadType {
        return LoadType::create(
            $id ? LoadTypeId::create($id) : null,
            Name::create($name),
        );
    }
}
