<?php

namespace App\Src\Domain\Repositories;

interface ImportFileRepository
{
    /**
     * @param ImportFile[] $files
     */
    public function store(array $files): string;
}