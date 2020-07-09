<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Prices;

use DateTimeInterface;

class Price
{
    /** @var DateTimeInterface */
    protected $interval;

    /** @var int */
    protected $fiveMinutePeriod;

    /** @var bool */
    protected $isDaylightSavingsHour;

    /** @var string */
    protected $node;

    /** @var float */
    protected $load;

    /** @var float */
    protected $generation;

    /** @var float */
    protected $price;

    /**
     * @return DateTimeInterface
     */
    public function getInterval(): DateTimeInterface
    {
        return $this->interval;
    }

    /**
     * @param DateTimeInterface $interval
     */
    public function setInterval(DateTimeInterface $interval): void
    {
        $this->interval = $interval;
    }

    /**
     * @return int
     */
    public function getFiveMinutePeriod(): int
    {
        return $this->fiveMinutePeriod;
    }

    /**
     * @param int $fiveMinutePeriod
     */
    public function setFiveMinutePeriod(int $fiveMinutePeriod): void
    {
        $this->fiveMinutePeriod = $fiveMinutePeriod;
    }

    /**
     * @return bool
     */
    public function isDaylightSavingsHour(): bool
    {
        return $this->isDaylightSavingsHour;
    }

    /**
     * @param bool $isDaylightSavingsHour
     */
    public function setIsDaylightSavingsHour(bool $isDaylightSavingsHour): void
    {
        $this->isDaylightSavingsHour = $isDaylightSavingsHour;
    }

    /**
     * @return string
     */
    public function getNode(): string
    {
        return $this->node;
    }

    /**
     * @param string $node
     */
    public function setNode(string $node): void
    {
        $this->node = $node;
    }

    /**
     * @return float
     */
    public function getLoad(): float
    {
        return $this->load;
    }

    /**
     * @param float $load
     */
    public function setLoad(float $load): void
    {
        $this->load = $load;
    }

    /**
     * @return float
     */
    public function getGeneration(): float
    {
        return $this->generation;
    }

    /**
     * @param float $generation
     */
    public function setGeneration(float $generation): void
    {
        $this->generation = $generation;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}
