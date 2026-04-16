<?php

namespace App\Src\Infrastructure\Company\Persistence\Models;

use Database\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class CompanyModel extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $table = 'companies';

    protected $fillable = [
        'code',
        'name',
    ];

    protected static function newFactory()
    {
        return CompanyFactory::new();
    }
}
