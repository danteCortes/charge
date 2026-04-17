<?php

namespace App\Src\Domain\SystemField\Factories;

use App\Src\Domain\SystemField\Entities\SystemField;
use App\Src\Domain\SystemField\Enums\Required;
use App\Src\Domain\SystemField\ValueObjects\Description;
use App\Src\Domain\SystemField\ValueObjects\Name;
use App\Src\Domain\SystemField\ValueObjects\SystemFieldId;

class SystemFieldFactory
{
    public static function fromPrimitives(
        ?string $id,
        string $name,
        ?string $description,
        bool $required
    ): SystemField {
        return SystemField::create(
            $id ? SystemFieldId::create($id) : null,
            Name::create($name),
            $description ? Description::create($description) : null,
            $required ? Required::YES : Required::NO
        );
    }
}
