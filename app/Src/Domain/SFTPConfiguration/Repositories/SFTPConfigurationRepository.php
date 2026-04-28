<?php

namespace App\Src\Domain\SFTPConfiguration\Repositories;

use App\Src\Domain\SFTPConfiguration\Entities\SFTPConfiguration;
use App\Src\Domain\SFTPConfiguration\ValueObjects\SFTPConfigurationId;

interface SFTPConfigurationRepository
{
    public function save(SFTPConfiguration $entity): SFTPConfiguration;

    public function findById(SFTPConfigurationId $id): ?SFTPConfiguration;
}
