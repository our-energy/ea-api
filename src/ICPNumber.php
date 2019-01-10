<?php

namespace OurEnergy\EMI;

/**
 * Represents an ICP object from the API response
 */
class ICPNumber
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
     * @return array
     */
    public function getAddress() : array
    {
        return $this->getData('Address');
    }

    /**
     * @return array
     */
    public function getNetwork() : array
    {
        return $this->getData('Network');
    }

    /**
     * @return array
     */
    public function getPricing() : array
    {
        return $this->getData('Pricing');
    }

    /**
     * @return array
     */
    public function getTrader() : array
    {
        return $this->getData('Trader');
    }

    /**
     * @return array
     */
    public function getMetering() : array
    {
        return $this->getData('Metering');
    }

    /**
     * @return string
     */
    public function getICPIdentifier() : string
    {
        return $this->getData('ICPIdentifier', null);
    }

    /**
     * @return string
     */
    public function getICPStatus() : string
    {
        return $this->getData('ICPStatus', null);
    }
    
    /**
     * Fetch a field from the data array
     *
     * @param string $name
     * @param array $default
     * @return mixed
     */
    private function getData(string $name, $default = [])
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }

        return $default;
    }
}