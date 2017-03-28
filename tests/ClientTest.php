<?php

namespace EasyPNR\Tests;

use EasyPNR;
use EasyPNR\Tests\Mocks\HttpClientFactory;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    const API_KEY = 'MY API KEY';

    /**
     * @test
     */
    public function should_create_a_client_using_constructor()
    {
        $client = new EasyPNR\Client(self::API_KEY);
        $this->assertInstanceOf(EasyPNR\Client::class, $client);
    }

    /**
     * @test
     */
    public function should_create_a_client_using_factory_method()
    {
        $client = EasyPNR\Client::withApiKey(self::API_KEY);
        $this->assertInstanceOf(EasyPNR\Client::class, $client);
    }

    /**
     * @test
     */
    public function should_throw_an_exception_when_no_api_key_provided()
    {
        $this->expectException(EasyPNR\Exception::class);
        new EasyPNR\Client('');
    }

    /**
     * @test
     */
    public function should_throw_an_exception_when_invalid_version_provided()
    {
        $this->expectException(EasyPNR\Exception::class);
        new EasyPNR\Client(self::API_KEY, 5);
    }

    /**
     * @test
     */
    public function should_response_with_pong_and_timestamp()
    {
        $client = new EasyPNR\Client(
            self::API_KEY,
            EasyPNR\Client::LATEST_VERSION,
            HttpClientFactory::makeWithPingResponse()
        );

        $pong = $client->ping();

        $this->assertStringStartsWith('pong', $pong);
    }

    /**
     * @test
     */
    public function should_throw_an_exception_on_error_for_ping_request()
    {
        $this->expectException(EasyPNR\Exception::class);

        $client = new EasyPNR\Client(
            self::API_KEY,
            EasyPNR\Client::LATEST_VERSION,
            HttpClientFactory::makeWithFailedResponse()
        );

        $client->ping();
    }

    /**
     * @test
     */
    public function should_return_decoded_pnr_structure_as_array()
    {
        $client = new EasyPNR\Client(
            self::API_KEY,
            EasyPNR\Client::LATEST_VERSION,
            HttpClientFactory::makeWithDecodeResponse()
        );

        $pnrSample = file_get_contents(__DIR__ . '/fixtures/encoded.txt');
        $response = $client->decode($pnrSample);

        $this->assertInternalType('array', $response);
        $this->assertNotEmpty($response);
    }

    /**
     * @test
     */
    public function should_throw_an_exception_on_error_for_decode_request()
    {
        $this->expectException(EasyPNR\Exception::class);

        $client = new EasyPNR\Client(
            self::API_KEY,
            EasyPNR\Client::LATEST_VERSION,
            HttpClientFactory::makeWithFailedResponse()
        );

        $pnrSample = 'Fake PNR';

        $client->decode($pnrSample);
    }
}
