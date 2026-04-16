<?php

namespace App\Src\Infrastructure\ProcessConfig\Persistence\Models;

use App\Src\Infrastructure\Company\Persistence\Models\CompanyModel;
use App\Src\Infrastructure\Layout\Persistence\Models\LayoutModel;
use App\Src\Infrastructure\LoadType\Persistence\Models\LoadTypeModel;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class ProcessConfigModel extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'process_configurations';

    protected $fillable = [
        'company_id',
        'load_type_id',
        'layout_id',
        'responsible',
        'process_type',
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
}
