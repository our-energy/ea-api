<?php

namespace OurEnergy\EMI\Tests;

use OurEnergy\EMI\ICP\Client;

class ICPClientTest extends BaseTestCase
{
    public function testGetICPData(): void
    {
        $client = new Client(
            self::SUBSCRIPTION_KEY,
            $this->getMockResponseHandler(file_get_contents(__DIR__ . '/GetByID.json'))
        );

        $icp = $client->getICPConnectionData('0000120725TR687');

        $this->assertEquals('0000120725TR687', $icp->ICPIdentifier);
    }

    public function testGetICPDataList(): void
    {
        $client = new Client(
            self::SUBSCRIPTION_KEY,
            $this->getMockResponseHandler(file_get_contents(__DIR__ . '/GetByList.json'))
        );

        $icpList = $client->getICPConnectionList([
            '0000120725TR687',
            '0000143772TR3FD'
        ]);

        $this->assertEquals(2, count($icpList));

        $this->assertEquals('0000120725TR687', $icpList[0]->ICPIdentifier);
        $this->assertEquals('0000143772TR3FD', $icpList[1]->ICPIdentifier);
    }

    public function testGetICPSearchResults(): void
    {
        $client = new Client(
            self::SUBSCRIPTION_KEY,
            $this->getMockResponseHandler(file_get_contents(__DIR__ . '/Search.json'))
        );

        $icpList = $client->getICPSearchResults('260', 'Tinakori');

        $this->assertEquals(2, count($icpList));

        $this->assertEquals('WELLINGTON', $icpList[0]->Address['PhysicalAddressTown']);
    }
}