<?php

namespace App\English\Application\Exception\User;

use Exception;
use Throwable;
class InvalidUserDataCredential extends Exception
{
    protected $code;
    protected $message;

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
