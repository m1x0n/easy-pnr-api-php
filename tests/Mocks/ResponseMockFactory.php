<?php

namespace EasyPNR\Tests\Mocks;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class ResponseMockFactory
{
    /**
     * @return MockHandler
     */
    public static function makePingResponse()
    {
        $responseMock = (new Response())
            ->withStatus(200)
            ->withBody(\GuzzleHttp\Psr7\stream_for('pong 1478969148631'));

        return new MockHandler([$responseMock]);
    }

    /**
     * @return MockHandler
     */
    public static function makeDecodeResponse()
    {
        $fixture = file_get_contents(__DIR__ . '/../fixtures/decoded.json');

        $responseMock = (new Response())
            ->withStatus(200)
            ->withBody(\GuzzleHttp\Psr7\stream_for($fixture));

        return new MockHandler([$responseMock]);
    }

    /**
     * @return MockHandler
     */
    public static function makeFailedResponse()
    {
        $responseMock = new RequestException(
            "",
            new Request('GET', '/'),
            (new Response())->withStatus(403)
        );

        return new MockHandler([$responseMock]);
    }
}
