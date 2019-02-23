<?php

namespace EMI\Tests;

use EMI\ICP\Client;
use EMI\ICP\ICPResult;

class ICPClientTest extends BaseTestCase
{
    public function testGetICPData(): void
    {
        $client = new Client(
            self::SUBSCRIPTION_KEY,
            $this->getMockResponseHandler(file_get_contents(__DIR__ . '/GetByID.json'))
        );

        $icp = $client->getICPConnectionData('0000120725TR687');

        $this->assertEquals('0000120725TR687', $icp->identifier);
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

        /** @var ICPResult $icp */
        foreach ($icpList as $icp) {
            $this->assertInstanceOf(ICPResult::class, $icp);
        }

        $this->assertEquals('0000120725TR687', $icpList[0]->identifier);
        $this->assertEquals('0000143772TR3FD', $icpList[1]->identifier);
    }

    public function testGetICPSearchResults(): void
    {
        $client = new Client(
            self::SUBSCRIPTION_KEY,
            $this->getMockResponseHandler(file_get_contents(__DIR__ . '/Search.json'))
        );

        $icpList = $client->getICPSearchResults('260', 'Tinakori');

        $this->assertEquals(2, count($icpList));

        $this->assertEquals('WELLINGTON', $icpList[0]->address['PhysicalAddressTown']);
    }
}
