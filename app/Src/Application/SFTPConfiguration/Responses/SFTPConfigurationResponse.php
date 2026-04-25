<?php

namespace App\Src\Application\SFTPConfiguration\Responses;

final class SFTPConfigurationResponse
{
    private function __construct(
        public readonly string $id,
        public readonly string $process_config_id,
        public readonly string $hostname,
        public readonly int $port,
        public readonly string $user,
        public readonly string $password,
        public readonly string $directory_path,
    ){}

    public static function create(
        string $id,
        string $process_config_id,
        string $hostname,
        int $port,
        string $user,
        string $password,
        string $directory_path,
    ): self
    {
        return new self(
            $id,
            $process_config_id,
            $hostname,
            $port,
            $user,
            $password,
            $directory_path,
        );
    }
}