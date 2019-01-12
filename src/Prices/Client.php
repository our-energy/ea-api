<?php

namespace OurEnergy\EMI\Prices;

use GuzzleHttp\Exception\GuzzleException;
use OurEnergy\EMI\Exceptions\InvalidResponse;
use OurEnergy\EMI\Exceptions\InvalidFilter;
use OurEnergy\EMI\BaseClient;
use \DateTime;

class Client extends BaseClient
{
    const PATH = "/rtp/";

    /**
     * @param DateTime|null $dateFrom
     * @param DateTime|null $dateTo
     *
     * @return array
     * @throws GuzzleException
     * @throws InvalidFilter
     * @throws InvalidResponse
     */
    public function getPrices(DateTime $dateFrom = null, DateTime $dateTo = null): array
    {
        if (!is_null($dateFrom) || !is_null($dateTo)) {
            if (!($dateFrom instanceof Datetime && $dateTo instanceof DateTime)) {
                throw new InvalidFilter("Both dateFrom and dateTo must be supplied");
            }
        }

        $filter = null;

        if ($dateFrom instanceof DateTime && $dateTo instanceof DateTime) {
            $filter = sprintf("interval_datetime gt datetime'%s' and interval_datetime lt datetime'%s'",
                $dateFrom->format(DateTime::ATOM),
                $dateTo->format(DateTime::ATOM)
            );
        }

        $data = $this->getRequest(self::PATH, [
            '$filter' => $filter
        ]);

        return $data;
    }

    /**
     * @param string $name
     * @param string $url
     *
     * @throws GuzzleException
     * @throws InvalidResponse
     */
    public function subscribe(string $name, string $url): void
    {
        $this->postRequest(self::PATH, [
            'name' => $name,
            'url' => $url
        ]);
    }

    /**
     * @param string $url
     *
     * @throws GuzzleException
     * @throws InvalidResponse
     */
    public function unsubscribe(string $url): void
    {
        $this->deleteRequest(self::PATH, sprintf('"%s"', $url));
    }

    /**
     * @return array
     * @throws GuzzleException
     * @throws InvalidResponse
     */
    public function getSubscriptions(): array
    {
        return $this->optionsRequest(self::PATH);
    }
}