<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp;

class Component
{
    /** @var string */
    protected $componentType;

    /** @var string */
    protected $serialNumber;

    /** @var string */
    protected $meterType;

    /** @var bool */
    protected $amiFlag;

    /** @var float */
    protected $compensationFactor;

    /** @var Channel[] */
    protected $channelInformation;

    /**
     * @return string
     */
    public function getComponentType(): string
    {
        return $this->componentType;
    }

    /**
     * @param string $componentType
     */
    public function setComponentType(string $componentType): void
    {
        $this->componentType = $componentType;
    }

    /**
     * @return string
     */
    public function getSerialNumber(): string
    {
        return $this->serialNumber;
    }

    /**
     * @param string $serialNumber
     */
    public function setSerialNumber(string $serialNumber): void
    {
        $this->serialNumber = $serialNumber;
    }

    /**
     * @return string
     */
    public function getMeterType(): string
    {
        return $this->meterType;
    }

    /**
     * @param string $meterType
     */
    public function setMeterType(string $meterType): void
    {
        $this->meterType = $meterType;
    }

    /**
     * @return bool
     */
    public function isAmiFlag(): bool
    {
        return $this->amiFlag;
    }

    /**
     * @param bool $amiFlag
     */
    public function setAmiFlag(bool $amiFlag): void
    {
        $this->amiFlag = $amiFlag;
    }

    /**
     * @return float
     */
    public function getCompensationFactor(): float
    {
        return $this->compensationFactor;
    }

    /**
     * @param float $compensationFactor
     */
    public function setCompensationFactor(float $compensationFactor): void
    {
        $this->compensationFactor = $compensationFactor;
    }

    /**
     * @return Channel[]
     */
    public function getChannelInformation(): array
    {
        return $this->channelInformation;
    }

    /**
     * @param array $channelInformation
     */
    public function setChannelInformation(array $channelInformation): void
    {
        $this->channelInformation = $channelInformation;
    }
}
