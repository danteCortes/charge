<?php

namespace App\Src\Infrastructure\ProcessConfig\Persistence\Models;

use App\Src\Infrastructure\Company\Persistence\Models\CompanyModel;
use App\Src\Infrastructure\ImportFile\Persistence\Models\ImportFileModel;
use App\Src\Infrastructure\Layout\Persistence\Models\LayoutModel;
use App\Src\Infrastructure\LoadType\Persistence\Models\LoadTypeModel;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\HasMany;

class ProcessConfigModel extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'processes';

    protected $fillable = [
        'company_id',
        'load_type_id',
        'layout_id',
        'responsible',
        'template_name',
        'start_date',
        'records',
        'status',
    ];

    protected $casts = [
        //
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(CompanyModel::class);
    }

    public function loadType(): BelongsTo
    {
        return $this->belongsTo(LoadTypeModel::class);
    }

    public function layout(): BelongsTo
    {
        return $this->belongsTo(LayoutModel::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(ImportFileModel::class, 'processConfig', '_id');
    }
}
