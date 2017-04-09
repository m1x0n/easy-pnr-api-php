<?php

namespace EasyPNR\Exceptions;

class UnrecognizedFormatException extends Exception
{
    public function __construct(
        $message = "Information couldn't be decoded. Unrecognized format",
        $code = 500,
        Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
