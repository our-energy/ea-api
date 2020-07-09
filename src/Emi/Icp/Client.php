<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp;

use OurEnergy\Emi\BaseClient;
use Psr\Http\Client\ClientExceptionInterface;
use OurEnergy\Emi\Icp\Factories\IcpFactory;

class Client extends BaseClient
{
    /**
     * @param string $identifier
     *
     * @return Icp
     * @throws ClientExceptionInterface
     */
    public function getById(string $identifier): Icp
    {
        $this->request("get", "ICPConnectionData/v2/single/?ICP=" . $identifier);

        $data = $this->parseBody($this->response);

        return IcpFactory::create($data[0]);
    }

    /**
     * @param array $identifiers
     *
     * @return Icp[]
     * @throws ClientExceptionInterface
     */
    public function getByIdList(array $identifiers): array
    {
        $this->request("get", "ICPConnectionData/v2/list/?ids=" . implode(",", $identifiers));

        $data = $this->parseBody($this->response);

        return IcpFactory::collection($data);
    }

    /**
     * @param string $streetNumber
     * @param string $streetName
     * @param string|null $suburbOrTown
     * @param string|null $region
     *
     * @return Icp[]
     * @throws ClientExceptionInterface
     */
    public function search(string $streetNumber, string $streetName, string $suburbOrTown = null, string $region = null): array
    {
        $query = [
            "streetNumber" => $streetNumber,
            "streetName" => $streetName,
            "suburbOrTown" => $suburbOrTown,
            "region" => $region
        ];

        $this->request("get", "ICPConnectionData/v2/search/?" . $this->buildQuery($query));

        $data = $this->parseBody($this->response);

        return IcpFactory::collection($data);
    }
}
