<?php

namespace App\Src\Shared\Exceptions;

use Exception;

final class NotFoundException extends Exception
{
    public function __construct(string $message = 'Resource not found.')
    {
        parent::__construct($message);
    }
}
