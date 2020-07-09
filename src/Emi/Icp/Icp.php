<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp;

class Icp
{
    /** @var string */
    protected $identifier;

    /** @var int */
    protected $status;

    /** @var Address */
    protected $address;

    /** @var Network */
    protected $network;

    /** @var Pricing */
    protected $pricing;

    /** @var Trader */
    protected $trader;

    /** @var Metering */
    protected $metering;

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    /**
     * @return Network
     */
    public function getNetwork(): Network
    {
        return $this->network;
    }

    /**
     * @param Network $network
     */
    public function setNetwork(Network $network): void
    {
        $this->network = $network;
    }

    /**
     * @return Pricing
     */
    public function getPricing(): Pricing
    {
        return $this->pricing;
    }

    /**
     * @param Pricing $pricing
     */
    public function setPricing(Pricing $pricing): void
    {
        $this->pricing = $pricing;
    }

    /**
     * @return Trader
     */
    public function getTrader(): Trader
    {
        return $this->trader;
    }

    /**
     * @param Trader $trader
     */
    public function setTrader(Trader $trader): void
    {
        $this->trader = $trader;
    }

    /**
     * @return Metering
     */
    public function getMetering(): Metering
    {
        return $this->metering;
    }

    /**
     * @param Metering $metering
     */
    public function setMetering(Metering $metering): void
    {
        $this->metering = $metering;
    }
}
