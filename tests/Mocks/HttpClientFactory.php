<?php

namespace EasyPNR\Tests\Mocks;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;

class HttpClientFactory
{
    /**
     * @param MockHandler $handler
     * @return Client
     */
    public static function make(MockHandler $handler)
    {
        return new Client(['handler' => $handler]);
    }

    /**
     * @return Client
     */
    public static function makeWithPingResponse()
    {
        return new Client([
            'handler' => ResponseMockFactory::makePingResponse()
        ]);
    }

    /**
     * @return Client
     */
    public static function makeWithDecodeResponse()
    {
        return new Client([
            'handler' => ResponseMockFactory::makeDecodeResponse()
        ]);
    }

    /**
     * @return Client
     */
    public static function makeWithFailedResponse()
    {
        return new Client([
            'handler' => ResponseMockFactory::makeFailedResponse()
        ]);
    }
}
