<?php

namespace EMI\ICP;

use EMI\BaseClient;
use EMI\Exceptions\InvalidResponse;
use GuzzleHttp\Exception\GuzzleException;

class Client extends BaseClient
{
    /**
     * @param string $icpNumber
     *
     * @return ICPResult
     * @throws GuzzleException
     * @throws InvalidResponse
     */
    public function getICPConnectionData(string $icpNumber): ICPResult
    {
        $data = $this->getRequest("/ICPConnectionData/single/", [
            'id' => $icpNumber
        ]);

        $icp = new ICPResult($data[0]);

        return $icp;
    }

    /**
     * @param array $icpNumbers
     *
     * @return array
     * @throws GuzzleException
     * @throws InvalidResponse
     */
    public function getICPConnectionList(array $icpNumbers): array
    {
        $icpNumbers = implode(",", $icpNumbers);

        $data = $this->getRequest("/ICPConnectionData/list/", [
            'ids' => $icpNumbers
        ]);

        $icpList = [];

        foreach ($data as $icpData) {
            $icpList[] = new ICPResult($icpData);
        }

        return $icpList;
    }

    /**
     * @param string $unitOrNumber
     * @param string $streetOrPropertyName
     * @param string|null $suburbOrTown
     * @param string|null $region
     *
     * @return array
     * @throws GuzzleException
     * @throws InvalidResponse
     */
    public function getICPSearchResults(
        string $unitOrNumber,
        string $streetOrPropertyName,
        string $suburbOrTown = null,
        string $region = null
    ): array
    {
        $data = $this->getRequest("/ICPConnectionData/search/", [
            'unitOrNumber' => $unitOrNumber,
            'streetOrPropertyName' => $streetOrPropertyName,
            'suburbOrTown' => $suburbOrTown,
            'region' => $region
        ]);

        $icpList = [];

        foreach ($data as $icpData) {
            $icpList[] = new ICPResult($icpData);
        }

        return $icpList;
    }
}