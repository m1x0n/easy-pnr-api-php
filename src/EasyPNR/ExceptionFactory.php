<?php

namespace EasyPNR;

use EasyPNR\Exceptions\AccessDeniedException;
use EasyPNR\Exceptions\Exception;
use EasyPNR\Exceptions\MaxRequestsException;
use EasyPNR\Exceptions\UnrecognizedFormatException;
use GuzzleHttp\Exception\RequestException;

class ExceptionFactory
{
    public static function make(\Exception $e)
    {
        if ($e instanceof RequestException) {
            $response = json_decode(
                $e->getResponse()->getBody()->getContents(),
                true
            );

            if (preg_match('/Access/', $response['message'])) {
                return new AccessDeniedException;
            }

            if (preg_match('/Information/', $response['message'])) {
                return new UnrecognizedFormatException;
            }

            if (preg_match('/maximum/', $response['message'])) {
                return new MaxRequestsException;
            }
        }

        return new Exception($e->getMessage());
    }
}
