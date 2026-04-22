<?php

namespace App\Src\Infrastructure\ImportFile\Persistence\Models;

use MongoDB\Laravel\Eloquent\Model;

class ImportFileModel extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'files';

    protected $fillable = [
        'fileName',
        'fileFormat',
        'fileSize',
        'storagePath',
        'decimalSeparator',
        'fileEncoding',
        'fileDelimiter',
        'spreadsheet',
        'processConfig',
        'firstRowHeaders',
        'key',
        'position',
        'validRows',
        'duplicatedRows',
        'errorRows',
    ];
}
