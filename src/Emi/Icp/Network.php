<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp;

use DateTimeInterface;

class Network
{
    /** @var string */
    protected $participantId;

    /** @var string */
    protected $participantName;

    /** @var string */
    protected $poc;

    /** @var string */
    protected $reconciliationType;

    /** @var DateTimeInterface */
    protected $initialElectricallyConnectedDate;

    /** @var float */
    protected $generationCapacity;

    /** @var string */
    protected $fuelType;

    /** @var string */
    protected $directBilledStatus;

    /**
     * @return string
     */
    public function getParticipantId(): string
    {
        return $this->participantId;
    }

    /**
     * @param string $participantId
     */
    public function setParticipantId(string $participantId): void
    {
        $this->participantId = $participantId;
    }

    /**
     * @return string
     */
    public function getParticipantName(): string
    {
        return $this->participantName;
    }

    /**
     * @param string $participantName
     */
    public function setParticipantName(string $participantName): void
    {
        $this->participantName = $participantName;
    }

    /**
     * @return string
     */
    public function getPoc(): string
    {
        return $this->poc;
    }

    /**
     * @param string $poc
     */
    public function setPoc(string $poc): void
    {
        $this->poc = $poc;
    }

    /**
     * @return string
     */
    public function getReconciliationType(): string
    {
        return $this->reconciliationType;
    }

    /**
     * @param string $reconciliationType
     */
    public function setReconciliationType(string $reconciliationType): void
    {
        $this->reconciliationType = $reconciliationType;
    }

    /**
     * @return DateTimeInterface
     */
    public function getInitialElectricallyConnectedDate(): DateTimeInterface
    {
        return $this->initialElectricallyConnectedDate;
    }

    /**
     * @param DateTimeInterface $initialElectricallyConnectedDate
     */
    public function setInitialElectricallyConnectedDate(DateTimeInterface $initialElectricallyConnectedDate): void
    {
        $this->initialElectricallyConnectedDate = $initialElectricallyConnectedDate;
    }

    /**
     * @return float
     */
    public function getGenerationCapacity(): float
    {
        return $this->generationCapacity;
    }

    /**
     * @param float $generationCapacity
     */
    public function setGenerationCapacity(float $generationCapacity): void
    {
        $this->generationCapacity = $generationCapacity;
    }

    /**
     * @return string
     */
    public function getFuelType(): string
    {
        return $this->fuelType;
    }

    /**
     * @param string $fuelType
     */
    public function setFuelType(string $fuelType): void
    {
        $this->fuelType = $fuelType;
    }

    /**
     * @return string
     */
    public function getDirectBilledStatus(): string
    {
        return $this->directBilledStatus;
    }

    /**
     * @param string $directBilledStatus
     */
    public function setDirectBilledStatus(string $directBilledStatus): void
    {
        $this->directBilledStatus = $directBilledStatus;
    }
}
