<?php

namespace App\Src\Domain\ImportFile\Repositories;

use App\Src\Domain\ImportFile\Entities\ImportFile;

interface ImportFileRepository
{
    /**
     * @param  ImportFile[]  $files
     */
    public function store(ImportFile $entity): ImportFile;

    public function update(ImportFile $entity): ImportFile;
}
