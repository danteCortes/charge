<?php

namespace App\Src\Domain\SFTPConfiguration\Factories;

use App\Src\Domain\SFTPConfiguration\Entities\SFTPConfiguration;
use App\Src\Domain\SFTPConfiguration\ValueObjects\DirectoryPath;
use App\Src\Domain\SFTPConfiguration\ValueObjects\Hostname;
use App\Src\Domain\SFTPConfiguration\ValueObjects\Password;
use App\Src\Domain\SFTPConfiguration\ValueObjects\Port;
use App\Src\Domain\SFTPConfiguration\ValueObjects\ProcessConfigId;
use App\Src\Domain\SFTPConfiguration\ValueObjects\SFTPConfigurationId;
use App\Src\Domain\SFTPConfiguration\ValueObjects\User;

class SFTPConfigurationFactory
{
    public static function fromPrimitives(
        ?string $id,
        string $processConfigId,
        string $hostname,
        int $port,
        string $user,
        string $password,
        string $directoryPath,
    ): SFTPConfiguration {
        return SFTPConfiguration::create(
            $id ? SFTPConfigurationId::create($id) : null,
            ProcessConfigId::create($processConfigId),
            Hostname::create($hostname),
            Port::create($port),
            User::create($user),
            Password::create($password),
            DirectoryPath::create($directoryPath),
        );
    }
}
