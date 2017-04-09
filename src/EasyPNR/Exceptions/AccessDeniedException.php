<?php

namespace EasyPNR\Exceptions;

class AccessDeniedException extends Exception
{
    public function __construct(
        $message = "Access Denied",
        $code = 403,
        Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
