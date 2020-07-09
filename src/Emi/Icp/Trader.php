<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp;

class Trader
{
    /** @var bool */
    protected $switchInProgress;

    /** @var string */
    protected $participantId;

    /** @var string */
    protected $participantName;

    /** @var string */
    protected $profileCode;

    /** @var string */
    protected $anzsicCode;

    /** @var float */
    protected $dailyUnmeteredKwh;

    /** @var string */
    protected $unmeteredLoadDetails;

    /**
     * @return bool
     */
    public function isSwitchInProgress(): bool
    {
        return $this->switchInProgress;
    }

    /**
     * @param bool $switchInProgress
     */
    public function setSwitchInProgress(bool $switchInProgress): void
    {
        $this->switchInProgress = $switchInProgress;
    }

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
    public function getProfileCode(): string
    {
        return $this->profileCode;
    }

    /**
     * @param string $profileCode
     */
    public function setProfileCode(string $profileCode): void
    {
        $this->profileCode = $profileCode;
    }

    /**
     * @return string
     */
    public function getAnzsicCode(): string
    {
        return $this->anzsicCode;
    }

    /**
     * @param string $anzsicCode
     */
    public function setAnzsicCode(string $anzsicCode): void
    {
        $this->anzsicCode = $anzsicCode;
    }

    /**
     * @return float
     */
    public function getDailyUnmeteredKwh(): float
    {
        return $this->dailyUnmeteredKwh;
    }

    /**
     * @param float $dailyUnmeteredKwh
     */
    public function setDailyUnmeteredKwh(float $dailyUnmeteredKwh): void
    {
        $this->dailyUnmeteredKwh = $dailyUnmeteredKwh;
    }

    /**
     * @return string
     */
    public function getUnmeteredLoadDetails(): string
    {
        return $this->unmeteredLoadDetails;
    }

    /**
     * @param string $unmeteredLoadDetails
     */
    public function setUnmeteredLoadDetails(string $unmeteredLoadDetails): void
    {
        $this->unmeteredLoadDetails = $unmeteredLoadDetails;
    }
}
