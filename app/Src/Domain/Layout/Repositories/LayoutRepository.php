<?php

namespace App\Src\Domain\Layout\Repositories;

interface LayoutRepository
{
    /**
     * @return Layout[]
     */
    public function list(): array;
}
