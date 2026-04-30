<?php

namespace App\Src\Domain\ProcessConfig\Repositories;

use App\Src\Domain\ProcessConfig\Entities\ProcessConfig;
use App\Src\Domain\ProcessConfig\ValueObjects\ProcessConfigId;
use App\Src\Shared\Domain\Entities\Paginate;
use App\Src\Shared\Domain\ValueObjects\Page;
use App\Src\Shared\Domain\ValueObjects\PerPage;
use App\Src\Shared\Domain\ValueObjects\Search;

interface ProcessConfigRepository
{
    public function save(ProcessConfig $entity): ProcessConfig;

    public function findById(ProcessConfigId $id): ?ProcessConfig;

    /**
     * @return App\Src\Domain\ImportFile\Entities\ImportFile[]
     */
    public function files(ProcessConfigId $id): array;

    public function search(Page $page, PerPage $perPage, ?Search $search): Paginate;
}
