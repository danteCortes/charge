<?php

namespace App\Src\Infrastructure\SFTPConfiguration\Persistence\Models;

use MongoDB\Laravel\Eloquent\Model;

class SFTPConfigurationModel extends Model
{
    protected $connection = 'mongodb';

    protected $table = 'sftp_configurations';

    protected $fillable = [
        'process_config_id',
        'hostname',
        'port',
        'user',
        'password',
        'directory_path',
    ];
}
