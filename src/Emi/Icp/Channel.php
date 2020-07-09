<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp;

class Channel
{
    /** @var string */
    protected $serialNumber;

    /** @var int */
    protected $channelNumber;

    /** @var string */
    protected $registerContentCode;

    /** @var int */
    protected $periodOfAvailability;

    /** @var string */
    protected $unitOfMeasurement;

    /** @var string */
    protected $energyFlowDirection;

    /** @var string */
    protected $accumulatorType;

    /** @var bool */
    protected $switchReadIndicator;

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
     * @return int
     */
    public function getChannelNumber(): int
    {
        return $this->channelNumber;
    }

    /**
     * @param int $channelNumber
     */
    public function setChannelNumber(int $channelNumber): void
    {
        $this->channelNumber = $channelNumber;
    }

    /**
     * @return string
     */
    public function getRegisterContentCode(): string
    {
        return $this->registerContentCode;
    }

    /**
     * @param string $registerContentCode
     */
    public function setRegisterContentCode(string $registerContentCode): void
    {
        $this->registerContentCode = $registerContentCode;
    }

    /**
     * @return int
     */
    public function getPeriodOfAvailability(): int
    {
        return $this->periodOfAvailability;
    }

    /**
     * @param int $periodOfAvailability
     */
    public function setPeriodOfAvailability(int $periodOfAvailability): void
    {
        $this->periodOfAvailability = $periodOfAvailability;
    }

    /**
     * @return string
     */
    public function getUnitOfMeasurement(): string
    {
        return $this->unitOfMeasurement;
    }

    /**
     * @param string $unitOfMeasurement
     */
    public function setUnitOfMeasurement(string $unitOfMeasurement): void
    {
        $this->unitOfMeasurement = $unitOfMeasurement;
    }

    /**
     * @return string
     */
    public function getEnergyFlowDirection(): string
    {
        return $this->energyFlowDirection;
    }

    /**
     * @param string $energyFlowDirection
     */
    public function setEnergyFlowDirection(string $energyFlowDirection): void
    {
        $this->energyFlowDirection = $energyFlowDirection;
    }

    /**
     * @return string
     */
    public function getAccumulatorType(): string
    {
        return $this->accumulatorType;
    }

    /**
     * @param string $accumulatorType
     */
    public function setAccumulatorType(string $accumulatorType): void
    {
        $this->accumulatorType = $accumulatorType;
    }

    /**
     * @return bool
     */
    public function isSwitchReadIndicator(): bool
    {
        return $this->switchReadIndicator;
    }

    /**
     * @param bool $switchReadIndicator
     */
    public function setSwitchReadIndicator(bool $switchReadIndicator): void
    {
        $this->switchReadIndicator = $switchReadIndicator;
    }
}
