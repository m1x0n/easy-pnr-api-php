<?php

namespace EasyPNR\Tests\Mocks;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class RequestExceptionFactory
{
    public static function make($statusCode, $body)
    {
        return new RequestException(
            "",
            new Request('GET', 'http://google.com'),
            (new Response())
                ->withStatus($statusCode)
                ->withBody(\GuzzleHttp\Psr7\stream_for(json_encode($body)))
        );
    }
}
