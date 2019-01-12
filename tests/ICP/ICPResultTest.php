<?php

namespace OurEnergy\EMI\Tests;

use OurEnergy\EMI\ICP\ICPResult;

class ICPResultTest extends BaseTestCase
{
    public function testICPIdentifier(): void
    {
        $data = [
            'ICPIdentifier' => '1234'
        ];

        $icp = new ICPResult($data);

        $this->assertEquals('1234', $icp->ICPIdentifier);
    }
}