<?php

namespace EasyPNR;

/**
 * Class Client
 * @package EasyPNR
 */
final class Client
{
    const ENDPOINT = 'https://api.easypnr.com/v%d/';
    const AUTH_HEADER = 'X-Api-Key';
    const LATEST_VERSION = 3;

    private $apiKey;
    private $apiVersion;
    private $client;

    public function __construct(
        $apiKey,
        $apiVersion = self::LATEST_VERSION,
        $httpClient = null
    ) {
        if (empty($apiKey)) {
            throw new Exception("Empty API key provided");
        }

        if (!in_array($apiVersion, [2, 3])) {
            throw new Exception(
                sprintf("Unsupported API version %d", $apiVersion)
            );
        }

        $this->apiKey = $apiKey;
        $this->apiVersion = $apiVersion;
        $this->client = $httpClient ?: new \GuzzleHttp\Client();
    }

    /**
     * @param $apiKey
     * @return Client
     */
    public static function withApiKey($apiKey)
    {
        return new self($apiKey);
    }

    /**
     * Ping the server
     *
     * @return string
     * @throws Exception
     */
    public function ping()
    {
        try {
            $response = $this->client->get(
                sprintf(self::ENDPOINT . "ping", $this->apiVersion),
                [
                    'headers' => [
                        self::AUTH_HEADER => $this->apiKey
                    ]
                ]
            );

            return $response->getBody()->getContents();
        } catch(\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Decode the PNR
     *
     * @param string $encodedPNR
     * @return array
     * @throws Exception
     */
    public function decode($encodedPNR)
    {
        try {
            $response = $this->client->post(
                sprintf(self::ENDPOINT . "decode", $this->apiVersion),
                [
                    'headers' => [
                        self::AUTH_HEADER => $this->apiKey,
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'body' => $encodedPNR
                ]
            );

            return json_decode($response->getBody()->getContents(), true);
        } catch(\Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
