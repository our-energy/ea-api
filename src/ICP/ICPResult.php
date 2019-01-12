<?php

namespace OurEnergy\EMI\ICP;

/**
 * Represents an ICP object from the API response
 *
 * @property-read string ICPIdentifier
 * @property-read string ICPStatus
 * @property-read array Address
 * @property-read array Network
 * @property-read array Pricing
 * @property-read array Trader
 * @property-read array Metering
 */
class ICPResult
{
    /**
     * @var array
     */
    private $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get(string $name)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
    }
}