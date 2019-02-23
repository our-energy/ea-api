<?php

namespace EMI\Dispatch;

use EMI\BaseClient;
use EMI\Prices\PriceResult;
use EMI\Exceptions\InvalidFilter;
use GuzzleHttp\Exception\GuzzleException;
use EMI\Exceptions\InvalidResponse;
use \DateTime;

/**
 * Class Client
 *
 * @package EMI\Dispatch
 */
class Client extends BaseClient
{
    const PATH = "/rtd/";

    /**
     * @param DateTime|null $dateFrom
     * @param DateTime|null $dateTo
     *
     * @return array
     * @throws GuzzleException
     * @throws InvalidFilter
     * @throws InvalidResponse
     */
    public function getDispatch(DateTime $dateFrom = null, DateTime $dateTo = null): array
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

        $priceList = array_map(function (array $item) {
            return new PriceResult($item);
        }, $data);

        return $priceList;
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
