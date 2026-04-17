<?php

namespace App\Src\Domain\LoadType\Repositories;

interface LoadTypeRepository
{
    /**
     * @return App\Src\Domain\LoadType\Entities\LoadType[]
     */
    public function list(): array;
}
