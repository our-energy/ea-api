<?php

namespace OurEnergy\Emi\Tests;

use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Http\Mock\Client;

abstract class BaseTestCase extends TestCase
{
    /**
     * @param string $body
     * @param int $status
     *
     * @return ClientInterface
     */
    protected function getMockHttpClient(string $body = "", int $status = 200): ClientInterface
    {
        $headers = [
            'Content-Type' => 'application/json'
        ];

        $mockResponse = new Response($status, $headers, $body);

        $mockClient = new Client();
        $mockClient->addResponse($mockResponse);

        return $mockClient;
    }
}
