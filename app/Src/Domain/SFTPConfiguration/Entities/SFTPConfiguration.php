<?php

namespace App\Src\Domain\SFTPConfiguration\Entities;

use App\Src\Domain\SFTPConfiguration\ValueObjects\SFTPConfigurationId;
use App\Src\Domain\SFTPConfiguration\ValueObjects\ProcessConfigId;
use App\Src\Domain\SFTPConfiguration\ValueObjects\Hostname;
use App\Src\Domain\SFTPConfiguration\ValueObjects\Port;
use App\Src\Domain\SFTPConfiguration\ValueObjects\User;
use App\Src\Domain\SFTPConfiguration\ValueObjects\Password;
use App\Src\Domain\SFTPConfiguration\ValueObjects\DirectoryPath;

class SFTPConfiguration
{
    private function __construct(
        private readonly ?SFTPConfigurationId $id,
        private readonly ProcessConfigId $processConfigId,
        private readonly Hostname $hostname,
        private readonly Port $port,
        private readonly User $user,
        private readonly Password $password,
        private readonly DirectoryPath $directoryPath,
    ) {}

    public static function create(
        ?SFTPConfigurationId $id,
        ProcessConfigId $processConfigId,
        Hostname $hostname,
        Port $port,
        User $user,
        Password $password,
        DirectoryPath $directoryPath,
    ): self {
        return new self(
            $id,
            $processConfigId,
            $hostname,
            $port,
            $user,
            $password,
            $directoryPath,
        );
    }

    public function id(): ?SFTPConfigurationId
    {
        return $this->id;
    }
    
    public function processConfigId(): ProcessConfigId {
        return $this->processConfigId;
    }

    public function hostname(): Hostname {
        return $this->hostname;
    }

    public function port(): Port {
        return $this->port;
    }

    public function user(): User {
        return $this->user;
    }

    public function password(): Password {
        return $this->password;
    }

    public function directoryPath(): DirectoryPath {
        return $this->directoryPath;
    }
}