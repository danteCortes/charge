<?php

namespace App\Src\Domain\ProcessConfig\Factories;

use App\Src\Shared\Domain\Entities\Paginate;
use App\Src\Shared\Domain\ValueObjects\From;
use App\Src\Shared\Domain\ValueObjects\LastPage;
use App\Src\Shared\Domain\ValueObjects\Page;
use App\Src\Shared\Domain\ValueObjects\PerPage;
use App\Src\Shared\Domain\ValueObjects\To;
use App\Src\Shared\Domain\ValueObjects\Total;

class PaginateFactory
{
    public static function fromPrimitives(
        int $total,
        int $perPage,
        int $page,
        int $lastPage,
        ?int $from,
        ?int $to,
        array $items,
    ): Paginate {
        return Paginate::create(
            Total::create($total),
            PerPage::create($perPage),
            Page::create($page),
            LastPage::create($lastPage),
            $from ? From::create($from) : null,
            $to ? To::create($to) : null,
            $items,
        );
    }
}
