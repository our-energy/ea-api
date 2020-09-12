<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp;

class Metering
{
    /** @var string */
    protected $participantID;

    /** @var string */
    protected $participantName;

    /** @var array */
    protected $installationInformation;

    /**
     * @return string
     */
    public function getParticipantID(): string
    {
        return $this->participantID;
    }

    /**
     * @param string $participantID
     */
    public function setParticipantID(string $participantID): void
    {
        $this->participantID = $participantID;
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
     * @return Installation[]
     */
    public function getInstallationInformation(): array
    {
        return $this->installationInformation;
    }

    /**
     * @param array $installationInformation
     */
    public function setInstallationInformation(array $installationInformation): void
    {
        $this->installationInformation = $installationInformation;
    }
}
