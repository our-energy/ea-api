<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp;

use DateTimeInterface;

class Installation
{
    /** @var int */
    protected $category;

    /** @var string */
    protected $type;

    /** @var DateTimeInterface */
    protected $certificationExpiryDate;

    /** @var array */
    protected $componentInformation;

    /**
     * @return int
     */
    public function getCategory(): int
    {
        return $this->category;
    }

    /**
     * @param int $category
     */
    public function setCategory(int $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCertificationExpiryDate(): DateTimeInterface
    {
        return $this->certificationExpiryDate;
    }

    /**
     * @param DateTimeInterface $certificationExpiryDate
     */
    public function setCertificationExpiryDate(DateTimeInterface $certificationExpiryDate): void
    {
        $this->certificationExpiryDate = $certificationExpiryDate;
    }

    /**
     * @return Component[]
     */
    public function getComponentInformation(): array
    {
        return $this->componentInformation;
    }

    /**
     * @param array $componentInformation
     */
    public function setComponentInformation(array $componentInformation): void
    {
        $this->componentInformation = $componentInformation;
    }
}
