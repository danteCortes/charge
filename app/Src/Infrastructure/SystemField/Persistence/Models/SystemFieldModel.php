<?php

namespace App\Src\Infrastructure\SystemField\Persistence\Models;

use App\Src\Infrastructure\ColumnAssignment\Persistence\Models\ColumnAssignmentModel;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasMany;

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

    public function columnAssignmentsModel(): HasMany
    {
        return $this->hasMany(ColumnAssignmentModel::class, 'system_field_id', '_id');
    }
}
