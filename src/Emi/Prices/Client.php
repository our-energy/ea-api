<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Prices;

use DateTimeInterface;
use Exception;
use OurEnergy\Emi\BaseClient;
use OurEnergy\Emi\Exception\InvalidFilter;
use OurEnergy\Emi\Prices\Factories\PriceFactory;
use OurEnergy\Emi\Prices\Factories\SubscriptionFactory;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;

class Client extends BaseClient
{
    // Real-time Prices or Real-time Dispatch
    const ALLOWED_TYPES = ["rtp", "rtd"];

    /** @var string */
    protected $type;

    /**
     * Client constructor.
     *
     * @param string $type
     * @param string $subscriptionKey
     * @param ClientInterface $httpClient
     *
     * @throws Exception
     */
    public function __construct(string $type, string $subscriptionKey, ClientInterface $httpClient)
    {
        $type = strtolower($type);

        if (!in_array($type, self::ALLOWED_TYPES)) {
            throw new Exception("Type must be RTP or RTD");
        }

        $this->type = $type;

        parent::__construct($subscriptionKey, $httpClient);
    }

    /**
     * @param DateTimeInterface|null $start
     * @param DateTimeInterface|null $end
     *
     * @return Price[]
     * @throws ClientExceptionInterface
     * @throws InvalidFilter
     * @throws Exception
     */
    public function getPrices(DateTimeInterface $start = null, DateTimeInterface $end = null): array
    {
        $query = [];

        if (!is_null($start) || !is_null($end)) {
            if (!($start instanceof DateTimeInterface && $end instanceof DateTimeInterface)) {
                throw new InvalidFilter("Both start and end dates must be supplied for filtering");
            }
        }

        if ($start instanceof DateTimeInterface && $end instanceof DateTimeInterface) {
            $query['$filter'] = sprintf("interval_datetime gt datetime'%s' and interval_datetime lt datetime'%s'",
                $start->format(DateTimeInterface::ATOM),
                $end->format(DateTimeInterface::ATOM)
            );
        }

        $this->request("get", $this->type . "?" . $this->buildQuery($query));

        $data = $this->parseBody($this->response);

        return PriceFactory::collection($data);
    }

    /**
     * @param string $name
     * @param string $url
     *
     * @return bool
     * @throws ClientExceptionInterface
     */
    public function subscribe(string $name, string $url): bool
    {
        $body = [
            "name" => $name,
            "url" => $url
        ];

        $this->request("post", $this->type, json_encode($body));

        return in_array($this->response->getStatusCode(), [200, 304]);
    }

    /**
     * @return Subscription[]
     * @throws ClientExceptionInterface
     */
    public function getSubscriptions(): array
    {
        $this->request("options", $this->type);

        $data = $this->parseBody($this->response);

        return SubscriptionFactory::collection($data);
    }

    /**
     * @param string $url
     *
     * @return bool
     * @throws ClientExceptionInterface
     */
    public function unsubscribe(string $url): bool
    {
        $this->request("delete", $this->type, json_encode($url));

        return $this->response->getStatusCode() === 200;
    }
}
