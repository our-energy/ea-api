<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Prices;

use Exception;
use Psr\Http\Client\ClientInterface;
use Http\Discovery\Psr18ClientDiscovery;

class ClientFactory
{
    /**
     * @param string $type
     * @param string $subscriptionKey
     * @param ClientInterface|null $httpClient
     *
     * @return Client
     * @throws Exception
     */
    public static function create(string $type, string $subscriptionKey, ClientInterface $httpClient = null): Client
    {
        if ($httpClient === null) {
            $httpClient = Psr18ClientDiscovery::find();
        }

        return new Client($type, $subscriptionKey, $httpClient);
    }
}
