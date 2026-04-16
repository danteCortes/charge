<?php

namespace App\Src\Infrastructure\LoadType\Persistence\Models;

use MongoDB\Laravel\Eloquent\Model;

class LoadTypeModel extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'load_types';

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        //
    ];
}
