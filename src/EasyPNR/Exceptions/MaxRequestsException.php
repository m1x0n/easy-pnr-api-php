<?php

namespace EasyPNR\Exceptions;

class MaxRequestsException extends Exception
{
    public function __construct(
        $message = "Maximum number of requests reached",
        $code = 500,
        Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
