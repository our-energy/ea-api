<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp;

class Address
{
    /** @var string */
    protected $nameOrDescription;

    /** @var string */
    protected $unit;

    /** @var string */
    protected $number;

    /** @var string */
    protected $street;

    /** @var string */
    protected $suburb;

    /** @var string */
    protected $town;

    /** @var string */
    protected $region;

    /** @var string */
    protected $postCode;

    /** @var string */
    protected $gpsNorthing;

    /** @var string */
    protected $gpsEasting;

    /**
     * @return string
     */
    public function getNameOrDescription(): string
    {
        return $this->nameOrDescription;
    }

    /**
     * @param string $nameOrDescription
     */
    public function setNameOrDescription(string $nameOrDescription): void
    {
        $this->nameOrDescription = $nameOrDescription;
    }

    /**
     * @return string
     */
    public function getUnit(): string
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     */
    public function setUnit(string $unit): void
    {
        $this->unit = $unit;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getSuburb(): string
    {
        return $this->suburb;
    }

    /**
     * @param string $suburb
     */
    public function setSuburb(string $suburb): void
    {
        $this->suburb = $suburb;
    }

    /**
     * @return string
     */
    public function getTown(): string
    {
        return $this->town;
    }

    /**
     * @param string $town
     */
    public function setTown(string $town): void
    {
        $this->town = $town;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion(string $region): void
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getPostCode(): string
    {
        return $this->postCode;
    }

    /**
     * @param string $postCode
     */
    public function setPostCode(string $postCode): void
    {
        $this->postCode = $postCode;
    }

    /**
     * @return string
     */
    public function getGpsNorthing(): string
    {
        return $this->gpsNorthing;
    }

    /**
     * @param string $gpsNorthing
     */
    public function setGpsNorthing(string $gpsNorthing): void
    {
        $this->gpsNorthing = $gpsNorthing;
    }

    /**
     * @return string
     */
    public function getGpsEasting(): string
    {
        return $this->gpsEasting;
    }

    /**
     * @param string $gpsEasting
     */
    public function setGpsEasting(string $gpsEasting): void
    {
        $this->gpsEasting = $gpsEasting;
    }
}
