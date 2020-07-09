<?php

namespace OurEnergy\Emi\Tests\Prices;

use \DateTime;
use \Exception;
use OurEnergy\Emi\Exception\InvalidFilter;
use OurEnergy\Emi\Prices\Client;
use OurEnergy\Emi\Tests\BaseTestCase;

class ClientTest extends BaseTestCase
{
    public function testInvalidType(): void
    {
        $mockClient = $this->getMockHttpClient();

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Type must be RTP or RTD");

        new Client("test", "1234567890", $mockClient);
    }

    public function testInvalidFilter(): void
    {
        $mockClient = $this->getMockHttpClient(file_get_contents(__DIR__ . '/GetPrices.json'));

        $client = new Client("rtp", "1234567890", $mockClient);

        $this->expectException(InvalidFilter::class);
        $this->expectExceptionMessage("Both start and end dates must be supplied for filtering");

        $client->getPrices(
            null,
            new DateTime('2019-01-01 00:00:00')
        );
    }

    public function testGetPrices(): void
    {
        $mockClient = $this->getMockHttpClient(file_get_contents(__DIR__ . '/GetPrices.json'));

        $client = new Client("rtp", "1234567890", $mockClient);

        $prices = $client->getPrices();

        $this->assertCount(246, $prices);
    }

    public function testGetSubscriptions(): void
    {
        $mockClient = $this->getMockHttpClient(file_get_contents(__DIR__ . '/GetSubscriptions.json'));

        $client = new Client("rtp", "1234567890", $mockClient);

        $subscriptions = $client->getSubscriptions();

        $this->assertCount(2, $subscriptions);
        $this->assertEquals("https://someurl/", $subscriptions[0]["SubscribedUrl"]);
        $this->assertEquals("https://someotherurl/", $subscriptions[1]["SubscribedUrl"]);
    }

    public function testSubscribe(): void
    {
        $mockClient = $this->getMockHttpClient(file_get_contents(__DIR__ . '/Subscribe.txt'));

        $client = new Client("rtp", "1234567890", $mockClient);

        $result = $client->subscribe("Test", "http://someurl/");

        $body = (string)$client->getResponse()->getBody();

        $this->assertTrue($result);
        $this->assertStringContainsString("Data will be sent to http://someurl/", $body);
    }
}

