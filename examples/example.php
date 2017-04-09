<?php

// Usage example

require_once __DIR__ . '/../vendor/autoload.php';

// Please make sure that you obtained correct API key
$apiKey = 'YOUR API KEY HERE';

// Prepare your PNR data. See encoded.txt for more information
$pnrSample = file_get_contents(__DIR__ . '/../tests/fixtures/encoded.txt');

// You can create client in two ways
// 1. Via constructor:
$client = new EasyPNR\Client($apiKey);

// 2. Via factory method:
$client = EasyPNR\Client::withApiKey($apiKey);

// This should respond with pong and timestamp string
$pingResponse = $client->ping();

// This should respond with decoded array structure
// See decoded.json fixture for more information
$decoded = $client->decode($pnrSample);
