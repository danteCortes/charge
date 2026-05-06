<?php

namespace App\Src\Infrastructure\Country\Persistence\Models;

use App\Src\Infrastructure\Company\Persistence\Models\CompanyModel;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\HasMany;

class CountryModel extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'countries';

    protected $fillable = [
        'name',
        'alpha2',
        'alpha3',
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(CompanyModel::class, 'country_id', '_id');
    }
}
