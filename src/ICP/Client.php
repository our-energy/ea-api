<?php

namespace OurEnergy\EMI\ICP;

use OurEnergy\EMI\BaseClient;

class Client extends BaseClient
{
    /**
     * Gets connection data for an ICP number
     *
     * @param string $icpNumber
     * @return ICPResult
     */
    public function getICPConnectionData(string $icpNumber) : ICPResult
    {
        $data = $this->getRequest("/ICPConnectionData/single/", [
            'id' => $icpNumber
        ]);
        
        $icp = new ICPResult($data[0]);

        return $icp;
    }

    /**
     * Gets connection data for a set of ICP numbers
     *
     * @param array $icpNumbers
     * @return array
     */
    public function getICPConnectionList(array $icpNumbers) : array
    {
        $icpNumbers = implode(",", $icpNumbers);

        $data = $this->getRequest("/ICPConnectionData/list/", [
            'ids' => $icpNumbers
        ]);

        $icps = [];

        foreach ($data as $icpData) {
            $icps[] = new ICPResult($icpData);
        }

        return $icps;
    }

    /**
     * Search for ICPs by address
     *
     * @param string $unitOrNumber
     * @param string $streetOrPropertyName
     * @param string $suburbOrTown
     * @param string $region
     * @return array
     */
    public function getICPSearchResults(
        string $unitOrNumber, 
        string $streetOrPropertyName, 
        string $suburbOrTown = null, 
        string $region = null
    ) : array
    {
        $data = $this->getRequest("/ICPConnectionData/search/", [
            'unitOrNumber' => $unitOrNumber,
            'streetOrPropertyName' => $streetOrPropertyName,
            'suburbOrTown' => $suburbOrTown,
            'region' => $region
        ]);

        $icps = [];

        foreach ($data as $icpData) {
            $icps[] = new ICPResult($icpData);
        }

        return $icps;
    }
}