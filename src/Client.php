<?php

namespace OurEnergy\EMI;

class Client
{
    const RESPONSE_ICP_NOT_FOUND = '103';

    const BASE_URL = 'https://emi.azure-api.net';

    /**
     * @var GuzzleHttp\Client
     */
    private $client;

    /**
     * @param string $subscriptionKey
     */
    public function __construct(string $subscriptionKey)
    {
        $this->subscriptionKey = $subscriptionKey;

        $this->client = new \GuzzleHttp\Client();
    }

    /**
     * Gets connection data for an ICP number
     *
     * @param string $icpNumber
     * @return ICPNumber
     */
    public function getICPConnectionData(string $icpNumber) : ICPNumber
    {
        $data = $this->request("/ICPConnectionData/single/", [
            'id' => $icpNumber
        ]);

        if (!is_array($data)) {
            throw new \Exception("Malformed response data");   
        }

        $icp = new ICPNumber($data[0]);

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

        $data = $this->request("/ICPConnectionData/list/", [
            'ids' => $icpNumbers
        ]);

        if (!is_array($data)) {
            throw new \Exception("Malformed response data");   
        }

        $icps = [];

        foreach ($data as $icpData) {
            $icps[] = new ICPNumber($icpData);
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
    )
    {
        $data = $this->request("/ICPConnectionData/search/", [
            'unitOrNumber' => $unitOrNumber,
            'streetOrPropertyName' => $streetOrPropertyName,
            'suburbOrTown' => $suburbOrTown,
            'region' => $region
        ]);

        if (!is_array($data)) {
            throw new \Exception("Malformed response data");   
        }

        $icps = [];

        foreach ($data as $icpData) {
            $icps[] = new ICPNumber($icpData);
        }

        return $icps;
    }

    /**
     * Undocumented function
     *
     * @param string $path
     * @param array $query
     * @return array
     */
    private function request(string $path, array $query)
    {
        $response = $this->client->request('GET', self::BASE_URL . $path, [
            'headers' => [
                'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
            ],
            'query' => $query
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception("Request failed with status code {$response->getStatusCode()}");
        }

        $data = json_decode($response->getBody(), true);

        return $data;
    }
}