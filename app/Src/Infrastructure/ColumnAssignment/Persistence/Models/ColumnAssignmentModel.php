<?php

namespace App\Src\Infrastructure\ColumnAssignment\Persistence\Models;

use App\Src\Infrastructure\ImportFile\Persistence\Models\ImportFileModel;
use App\Src\Infrastructure\SystemFieldModel\Persistence\Models\SystemFieldModelModel;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class ColumnAssignmentModel extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'column_assignments';

    protected $fillable = [
        'import_file_id',
        'column_name',
        'system_field_id',
    ];

    protected $casts = [
        //
    ];

    public function importFileModel(): BelongsTo
    {
        return $this->belongsTo(ImportFileModel::class, 'import_file_id', '_id');
    }

    public function systemFieldModel(): BelongsTo
    {
        return $this->belongsTo(SystemFieldModelModel::class, 'system_field_id', '_id');
    }
}
