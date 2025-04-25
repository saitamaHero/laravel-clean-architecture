<?php

namespace App\Core\Shared\Exceptions;


class NotImplementedException extends \Exception
{
    public function __construct(string $message = "This feature is not supported yet")
    {
        parent::__construct($message, 1000);
    }
}
