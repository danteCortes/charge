<?php

namespace App\Src\Domain\ImportFile\Repositories;

use App\Src\Domain\ImportFile\Entities\ImportFile;
use App\Src\Domain\ImportFile\ValueObjects\FileId;

interface ImportFileRepository
{
    /**
     * @param  ImportFile[]  $files
     */
    public function store(ImportFile $entity): ImportFile;

    public function findById(FileId $id): ImportFile;

    public function delete(FileId $id): ImportFile;
}
