<?php

namespace App\Src\Infrastructure\ImportFile\Persistence\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use MongoDB\Laravel\Eloquent\Model;

class ImportFileModel extends Model
{
    use SoftDeletes;

    protected $connection = 'mongodb';

    protected $table = 'files';

    protected $fillable = [
        'name',
        'format',
        'size',
        'path',
        'separator',
        'encoding',
        'delimiter',
        'spreadsheet',
        'status',
        'process_config_id',
        'first_row_headers',
    ];
}
