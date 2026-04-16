<?php

namespace App\Src\Domain\ImportFile\Repositories;

use App\Src\Domain\ImportFile\Entities\ImportFile;
use App\Src\Domain\ImportFile\Enums\FileFormat;
use App\Src\Domain\ImportFile\ValueObjects\FilePreview;

interface FilePreviewGenerator
{
    public function supports(FileFormat $format): bool;

    public function preview(ImportFile $file): FilePreview;
}
