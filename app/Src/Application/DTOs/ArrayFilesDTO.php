<?php

namespace App\Src\Application\DTOs;

use InvalidArgumentException;

final class ArrayFilesDTO
{
    /**
     * @param  ImportFileDTO[]  $files
     */
    private function __construct(
        public readonly array $files
    ) {}

    /**
     * @param  ImportFileDTO[]  $files
     */
    public static function create(
        array $files
    ): self {
        foreach ($files as $key => $importFile) {
            if (! $importFile instanceof ImportFileDTO) {
                throw new InvalidArgumentException("El archivo $key no contiene un ImportFileDTO.");
            }
        }

        return new self($files);
    }
}
