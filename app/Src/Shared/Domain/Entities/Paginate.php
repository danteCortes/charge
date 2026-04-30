<?php

namespace App\Src\Shared\Domain\Entities;

use App\Src\Shared\Domain\ValueObjects\From;
use App\Src\Shared\Domain\ValueObjects\LastPage;
use App\Src\Shared\Domain\ValueObjects\Page;
use App\Src\Shared\Domain\ValueObjects\PerPage;
use App\Src\Shared\Domain\ValueObjects\To;
use App\Src\Shared\Domain\ValueObjects\Total;

final class Paginate
{
    private function __construct(
        private readonly Total $total,
        private readonly PerPage $perPage,
        private readonly Page $page,
        private readonly LastPage $lastPage,
        private readonly ?From $from,
        private readonly ?To $to,
        private readonly array $items,
    ) {}

    public static function create(
        Total $total,
        PerPage $perPage,
        Page $page,
        LastPage $lastPage,
        ?From $from,
        ?To $to,
        array $items,
    ): self {
        return new self(
            $total,
            $perPage,
            $page,
            $lastPage,
            $from,
            $to,
            $items,
        );
    }

    public function total(): Total
    {
        return $this->total;
    }

    public function perPage(): PerPage
    {
        return $this->perPage;
    }

    public function page(): Page
    {
        return $this->page;
    }

    public function lastPage(): LastPage
    {
        return $this->lastPage;
    }

    public function from(): ?From
    {
        return $this->from;
    }

    public function to(): ?To
    {
        return $this->to;
    }

    public function items(): array
    {
        return $this->items;
    }
}
