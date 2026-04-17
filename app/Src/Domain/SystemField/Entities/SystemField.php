<?php

namespace App\Src\Domain\SystemField\Entities;

use App\Src\Domain\SystemField\Enums\Required;
use App\Src\Domain\SystemField\ValueObjects\Description;
use App\Src\Domain\SystemField\ValueObjects\Name;
use App\Src\Domain\SystemField\ValueObjects\SystemFieldId;

class SystemField
{
    private function __construct(
        private readonly ?SystemFieldId $id,
        private readonly Name $name,
        private readonly ?Description $description,
        private readonly Required $required,
    ) {}

    public static function create(
        ?SystemFieldId $id,
        Name $name,
        ?Description $description,
        Required $required,
    ): self {
        return new self(
            $id,
            $name,
            $description,
            $required,
        );
    }

    public function id(): ?SystemFieldId
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function description(): ?Description
    {
        return $this->description;
    }

    public function isRequired(): bool
    {
        return $this->required === Required::YES;
    }
}
