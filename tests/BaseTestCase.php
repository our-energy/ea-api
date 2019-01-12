<?php

namespace OurEnergy\EMI\Tests;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

class BaseTestCase extends TestCase
{
    const SUBSCRIPTION_KEY = '1234567890';

    /**
     * @param string $body
     * @param int $code
     *
     * @return HandlerStack
     */
    protected function getMockResponseHandler(string $body, int $code = 200): HandlerStack
    {
        $mock = new MockHandler([
            new Response(
                $code,
                ['Content-Type' => 'application/json'],
                $body
            )
        ]);

        $handler = HandlerStack::create($mock);

        return $handler;
    }
}