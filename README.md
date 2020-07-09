[![Build Status](https://travis-ci.org/our-energy/ea-api.svg?branch=master)](https://travis-ci.org/our-energy/ea-api)
[![Latest Stable Version](https://poser.pugx.org/ourenergy/ea-api/v/stable?format=flat)](https://packagist.org/packages/ourenergy/ea-api)

# Electricity Market Information API

A PHP wrapper for the [Electricity Authority's EMI API](https://emi.portal.azure-api.net/). Supports PHP 7.1+.

You must have an active subscription key for the API you wish you use.

Requires a valid HTTPlug-compatible client, like [php-http/guzzle6-adapter](https://github.com/php-http/guzzle6-adapter).

## Installation

```
composer require ourenergy/ea-api
```

## Prices

Retrieves five-minute pricing data. Client type can be one of the following;

* `rtp` - Real-time prices
* `rtd` - Real-time dispatch

### Get the latest prices

```php
use OurEnergy\Emi\Prices\Factories\ClientFactory;

$subscriptionKey = "your subscription key";

$client = ClientFactory::create("rtp", $subscriptionKey);

$prices = $client->getPrices();

print_r($prices);
```

### Get prices within a date range

```php
$prices = $client->getPrices(
    new DateTime("2019-01-01 00:00:00"),
    new DateTime("2019-01-01 00:30:00")
);

print_r($prices);
```

### Subscribe to push updates

```php
$serviceName = "Your service";
$callbackUrl = "http://yourwebsite.com";

$client->subscribe($serviceName, $callbackUrl);
```

### Unsubscribe from push updates

```php
$client->unsubscribe($callbackUrl);
```
### Get a list of current subscriptions

```php
$subscriptions = $client->getSubscriptions();

print_r($subscriptions);
```

## ICP connection data

Provides methods to get data on Installation Control Points.

### Look up an ICP number

```php
use OurEnergy\Emi\Icp\Factories\ClientFactory;

$subscriptionKey = "your subscription key";

$client = ClientFactory::create($subscriptionKey);

$icp = $client->getById("0000143418TRD9F");

echo $icp->getNetwork()->getParticipantId();
```

### Look up a list of ICP numbers

```php
$icps = $client->getByIdList([
    "0000143418TRD9F",
    "0000130040TR3DB"
]);

print_r($icps);
```

### Search by address

```php
$icps = $client->search("260", "Tinakori");

print_r($icps);
```

