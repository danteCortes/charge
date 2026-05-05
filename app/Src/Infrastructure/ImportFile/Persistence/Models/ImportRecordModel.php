<?php

namespace App\Src\Infrastructure\ImportFile\Persistence\Models;

use MongoDB\Laravel\Eloquent\Model;

class ImportRecordModel extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'import_records';

    protected $fillable = [
        'import_file_id',
        'data',
        'status',
        'key_value',
    ];
}
