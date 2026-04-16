<?php

namespace App\Src\Domain\ProcessConfig\Repositories;

use App\Src\Domain\ProcessConfig\Entities\ProcessConfig;
use App\Src\Domain\ProcessConfig\ValueObjects\ProcessConfigId;

interface ProcessConfigRepository
{
    public function save(ProcessConfig $entity): ProcessConfig;

    public function findById(ProcessConfigId $id): ?ProcessConfig;
}
