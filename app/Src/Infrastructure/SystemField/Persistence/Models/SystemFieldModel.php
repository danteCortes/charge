<?php

namespace App\Src\Infrastructure\SystemField\Persistence\Models;

use MongoDB\Laravel\Eloquent\Model;

class SystemFieldModel extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'system_fields';

    protected $fillable = [
        'name',
        'description',
        'required',
    ];

    protected $casts = [
        //
    ];
}
