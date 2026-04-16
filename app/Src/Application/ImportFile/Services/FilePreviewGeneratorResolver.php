<?php

namespace App\Src\Application\ImportFile\Services;

use App\Src\Domain\ImportFile\Enums\FileFormat;
use App\Src\Domain\ImportFile\Repositories\FilePreviewGenerator;

class FilePreviewGeneratorResolver
{
    /**
     * @param  FilePreviewGenerator[]  $generators
     */
    public function __construct(
        private array $generators
    ) {}

    public function resolve(FileFormat $format): FilePreviewGenerator
    {
        foreach ($this->generators as $generator) {
            if ($generator->supports($format)) {
                return $generator;
            }
        }

        throw new \RuntimeException("No preview generator found for format: {$format->value}");
    }
}
