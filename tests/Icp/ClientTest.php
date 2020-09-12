<?php

namespace OurEnergy\Emi\Tests\Icp;

use OurEnergy\Emi\Exception\ApiException;
use OurEnergy\Emi\Icp\Client;
use OurEnergy\Emi\Icp\Component;
use OurEnergy\Emi\Icp\Installation;
use OurEnergy\Emi\Tests\BaseTestCase;

class ClientTest extends BaseTestCase
{
    public function testGetById(): void
    {
        $mockClient = $this->getMockHttpClient(file_get_contents(__DIR__ . '/GetByID.json'));

        $client = new Client("1234567890", $mockClient);

        $icp = $client->getById("0000120725TR687");

        $this->assertEquals("0000120725TR687", $icp->getIdentifier());
        $this->assertEquals(2, $icp->getStatus());
        $this->assertEquals("Wellington", $icp->getAddress()->getRegion());
        $this->assertEquals("CKHK", $icp->getNetwork()->getParticipantId());
        $this->assertEquals("RSUTOU", $icp->getPricing()->getPriceCategoryCode());
        $this->assertEquals("CTCT", $icp->getTrader()->getParticipantId());
        $this->assertEquals("NGCM", $icp->getMetering()->getParticipantID());
        $this->assertCount(1, $icp->getMetering()->getInstallationInformation());

        $installation = $icp->getMetering()->getInstallationInformation()[0];

        $this->assertEquals("2030-06-11", $installation->getCertificationExpiryDate()->format("Y-m-d"));

        $component = $installation->getComponentInformation()[0];

        $this->assertEquals("214279822", $component->getSerialNumber());
        $this->assertCount(4, $component->getChannelInformation());
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

    public function testInvalidFormat(): void
    {
        $mockClient = $this->getMockHttpClient(file_get_contents(__DIR__ . '/InvalidFormat.json'), 400);

        $client = new Client("1234567890", $mockClient);

        $this->expectException(ApiException::class);
        $this->expectExceptionMessage("Invalid ICP. An ICP is a 15 character string, comprised of 10 digits, 2 characters, and 3 hexi-decimal characters.");
        $this->expectExceptionCode(400);

        $client->getById("XXXXXXXX");
    }

    public function testNotFound(): void
    {
        $mockClient = $this->getMockHttpClient(file_get_contents(__DIR__ . '/NotFound.json'), 404);

        $client = new Client("1234567890", $mockClient);

        $this->expectException(ApiException::class);
        $this->expectExceptionMessage("ICP not found in the registry.");
        $this->expectExceptionCode(404);

        $client->getById("1234567890AA111");
    }
}
