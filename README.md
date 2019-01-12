# Electricity Market Information API

A PHP wrapper for the [Electricity Authority's EMI API](https://emi.portal.azure-api.net/). Supports PHP 7.1+.

You must have an active subscription key for the API you wish you use.

## Installation

```
composer require ourenergy/ea-api
```

## Real-time prices

Retrieves five-minute pricing data.

### Get the latest prices

```php
$client = new OurEnergy\EMI\Prices\Client('[YOUR SUBSCRIPTION KEY]');

$spotPrices = $client->getPrices();

print_r($spotPrices);
```

### Get prices within a date range

```php
$client = new OurEnergy\EMI\Prices\Client('[YOUR SUBSCRIPTION KEY]');

$spotPrices = $client->getPrices(
    new DateTime("2019-01-01 00:00:00"),
    new DateTime("2019-01-01 00:30:00")
);

print_r($spotPrices);
```

### Subscribe to push updates

```php
$client = new OurEnergy\EMI\Prices\Client('[YOUR SUBSCRIPTION KEY]');

$client->subscribe("[YOUR SERVICE NAME]", "[YOUR CALLBACK URL]");
```

### Unsubscribe from push updates

```php
$client = new OurEnergy\EMI\Prices\Client('[YOUR SUBSCRIPTION KEY]');

$client->unsubscribe("[YOUR CALLBACK URL]");
```
### Get a list of current subscriptions

```php
$client = new OurEnergy\EMI\Prices\Client('[YOUR SUBSCRIPTION KEY]');

$subscriptions = $client->getSubscriptions();

print_r($subscriptions);
```

## ICP connection data

Provides methods to get data on Installation Control Points.

### Look up an ICP number

```php
$client = new OurEnergy\EMI\ICP\Client('[YOUR SUBSCRIPTION KEY]');

$icp = $client->getICPConnectionData('0000143418TRD9F');

echo $icp->Pricing['DistributorPriceCategoryCode'] . PHP_EOL;
```

### Look up a list of ICP numbers

```php
$client = new OurEnergy\EMI\ICP\Client('[YOUR SUBSCRIPTION KEY]');

$icpResults = $client->getICPConnectionList([
    '0000143418TRD9F',
    '0000130040TR3DB'
]);

print_r($icpResults);
```

### Search by address

```php
$client = new OurEnergy\EMI\ICP\Client('[YOUR SUBSCRIPTION KEY]');

$icpResults = $client->getICPSearchResults('260', 'Tinakori');

print_r($icpResults);
```

## Real-time dispatch

TODO