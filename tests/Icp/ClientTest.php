<?php

namespace OurEnergy\Emi\Tests\Icp;

use OurEnergy\Emi\Icp\Client;
use OurEnergy\Emi\Tests\BaseTestCase;

class ClientTest extends BaseTestCase
{
    public function testGetById(): void
    {
        $mockClient = $this->getMockHttpClient(file_get_contents(__DIR__ . '/GetByID.json'));

        $client = new Client("1234567890", $mockClient);

        $icp = $client->getById("0000120725TR687");

        $this->assertEquals("0000120725TR687", $icp->getIdentifier());
    }

    public function testGetByIdList(): void
    {
        $mockClient = $this->getMockHttpClient(file_get_contents(__DIR__ . '/GetByIDList.json'));

        $client = new Client("1234567890", $mockClient);

        $icps = $client->getByIdList([
            "0000120725TR687",
            "0000143772TR3FD"
        ]);

        $this->assertCount(2, $icps);
        $this->assertEquals('0000120725TR687', $icps[0]->getIdentifier());
        $this->assertEquals('0000143772TR3FD', $icps[1]->getIdentifier());
    }

    public function testSearch(): void
    {
        $mockClient = $this->getMockHttpClient(file_get_contents(__DIR__ . '/Search.json'));

        $client = new Client("1234567890", $mockClient);

        $icps = $client->search("260", "Tinakori");

        $this->assertCount(2, $icps);
        $this->assertEquals('0000120725TR687', $icps[0]->getIdentifier());
        $this->assertEquals('0000143772TR3FD', $icps[1]->getIdentifier());
    }
}
