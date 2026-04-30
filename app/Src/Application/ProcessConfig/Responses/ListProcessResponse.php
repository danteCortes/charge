<?php

namespace App\Src\Application\ProcessConfig\Responses;

final class ListProcessResponse
{
    private function __construct(
        public readonly int $total,
        public readonly int $perPage,
        public readonly int $page,
        public readonly int $lastPage,
        public readonly ?int $from,
        public readonly ?int $to,
        public readonly array $items,
    ) {}

    public static function create(
        int $total,
        int $perPage,
        int $page,
        int $lastPage,
        ?int $from,
        ?int $to,
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
}
