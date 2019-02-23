<?php

namespace EMI\Tests;

use GuzzleHttp\Exception\ClientException;
use EMI\Dispatch\Client;
use EMI\Exceptions\InvalidFilter;
use EMI\Prices\PriceResult;
use \DateTime;

class DispatchClientTest extends BaseTestCase
{
    public function testInvalidFilter(): void
    {
        $this->expectException(InvalidFilter::class);

        $client = new Client(self::SUBSCRIPTION_KEY);

        $client->getDispatch(
            null,
            new DateTime('2019-01-01 00:00:00')
        );
    }

    public function testGetDispatch(): void
    {
        $client = new Client(
            self::SUBSCRIPTION_KEY,
            $this->getMockResponseHandler(file_get_contents(__DIR__ . '/GetDispatch.json'))
        );

        $prices = $client->getDispatch();

        $this->assertEquals(4, count($prices));

        foreach ($prices as $price) {
            $this->assertInstanceOf(PriceResult::class, $price);
            $this->assertIsNumeric($price->price);
        }
    }

    public function testGetSubscriptions(): void
    {
        $client = new Client(
            self::SUBSCRIPTION_KEY,
            $this->getMockResponseHandler(file_get_contents(__DIR__ . '/GetSubscriptions.json'))
        );

        $subscriptions = $client->getSubscriptions();

        $this->assertEquals(2, count($subscriptions));
    }

    public function testInvalidUnsubscribe(): void
    {
        $this->expectException(ClientException::class);
        $this->expectExceptionCode(404);

        $client = new Client(
            self::SUBSCRIPTION_KEY,
            $this->getMockResponseHandler("", 404)
        );

        $client->unsubscribe("http://nonexistent/");
    }
}
