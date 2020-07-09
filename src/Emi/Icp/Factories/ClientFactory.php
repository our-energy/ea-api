<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp\Factories;

use Psr\Http\Client\ClientInterface;
use Http\Discovery\Psr18ClientDiscovery;
use OurEnergy\Emi\Icp\Client;

class ClientFactory
{
    public static function create(string $subscriptionKey, ClientInterface $httpClient = null): Client
    {
        if ($httpClient === null) {
            $httpClient = Psr18ClientDiscovery::find();
        }

        return new Client($subscriptionKey, $httpClient);
    }
}
