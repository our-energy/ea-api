<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp;

class Pricing
{
    /** @var string */
    protected $priceCategoryCode;

    /** @var string */
    protected $lossCategoryCode;

    /** @var float */
    protected $chargeableCapacity;

    /** @var string */
    protected $installationDetails;

    /**
     * @return string
     */
    public function getPriceCategoryCode(): string
    {
        return $this->priceCategoryCode;
    }

    /**
     * @param string $priceCategoryCode
     */
    public function setPriceCategoryCode(string $priceCategoryCode): void
    {
        $this->priceCategoryCode = $priceCategoryCode;
    }

    /**
     * @return string
     */
    public function getLossCategoryCode(): string
    {
        return $this->lossCategoryCode;
    }

    /**
     * @param string $lossCategoryCode
     */
    public function setLossCategoryCode(string $lossCategoryCode): void
    {
        $this->lossCategoryCode = $lossCategoryCode;
    }

    /**
     * @return float
     */
    public function getChargeableCapacity(): float
    {
        return $this->chargeableCapacity;
    }

    /**
     * @param float $chargeableCapacity
     */
    public function setChargeableCapacity(float $chargeableCapacity): void
    {
        $this->chargeableCapacity = $chargeableCapacity;
    }

    /**
     * @return string
     */
    public function getInstallationDetails(): string
    {
        return $this->installationDetails;
    }

    /**
     * @param string $installationDetails
     */
    public function setInstallationDetails(string $installationDetails): void
    {
        $this->installationDetails = $installationDetails;
    }
}
