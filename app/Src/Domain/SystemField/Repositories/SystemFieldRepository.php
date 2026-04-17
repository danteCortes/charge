<?php

namespace App\Src\Domain\SystemField\Repositories;

interface SystemFieldRepository
{
    /**
     * @return App\Src\Domain\SystemField\Entities\SystemField[]
     */
    public function list(): array;
}
