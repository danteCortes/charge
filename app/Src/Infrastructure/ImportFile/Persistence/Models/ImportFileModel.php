<?php

namespace App\Src\Infrastructure\ImportFile\Persistence\Models;

use App\Src\Infrastructure\ColumnAssignment\Persistence\Models\ColumnAssignmentModel;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasMany;

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

    public function columnAssignmentsModel(): HasMany
    {
        return $this->hasMany(ColumnAssignmentModel::class, 'import_file_id', '_id');
    }
}
