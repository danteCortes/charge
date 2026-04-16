<?php

namespace App\Src\Infrastructure\Layout\Persistence\Models;

use MongoDB\Laravel\Eloquent\Model;

class LayoutModel extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'layouts';

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        //
    ];
}
