easy-pnr-api-php [![Build Status](https://travis-ci.org/m1x0n/easy-pnr-api-php.svg?branch=master)](https://travis-ci.org/m1x0n/easy-pnr-api-php)
====

PHP API Client for EasyPNR Decoder: [https://www.easypnr.com](https://www.easypnr.com)

## Installation

```cli
composer require m1x0n/easy-pnr-api-php
```

## Usage

```php
<?php

// Usage example

require_once __DIR__ . '/../vendor/autoload.php';

// Please make sure that you obtained correct API key
$apiKey = 'YOUR API KEY HERE';

// Prepare your PNR data. See encoded.txt for more information
$pnrSample = file_get_contents(__DIR__ . '../tests/fixtures/encoded.txt');

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
```

## Documentation

You can found latest documentation here:
[http://docs.easypnr.com/api/v3/](http://docs.easypnr.com/api/v3/)

More about Passengers Name Record (PNR) on [wiki](https://en.wikipedia.org/wiki/Passenger_name_record)
