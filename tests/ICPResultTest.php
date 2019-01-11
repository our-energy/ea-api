<?php

namespace OurEnergy\EMI\Tests;

use PHPUnit\Framework\TestCase;
use OurEnergy\EMI\ICP\ICPResult;

class ICPResultTest extends TestCase
{
    public function testICPIdentifier()
    {
        $data = [
            'ICPIdentifier' => '1234'
        ];

        $icp = new ICPResult($data);

        $this->assertEquals($icp->getICPIdentifier(), '1234');
    }
}