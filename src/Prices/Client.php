<?php

namespace OurEnergy\EMI\Prices;

use OurEnergy\EMI\BaseClient;
use \DateTime;

class Client extends BaseClient
{
    const PATH = "/rtp/";

    public function getPrices(DateTime $dateFrom, DateTime $dateTo = null) : array
    {
        if (!is_null($dateFrom) || !is_null($dateTo)) {
            if (!($dateFrom instanceof Datetime && $dateTo instanceof DateTime)) {
                throw new \Exception("Both dateFrom and dateTo must be supplied");
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

    public function subscribe(string $name, string $url)
    {
        $this->postRequest(self::PATH, [
            'name' => $name,
            'url' => $url
        ]);
    }

    public function unsubscribe(string $url)
    {
        return $this->deleteRequest(self::PATH, sprintf('"%s"', $url));
    }

    public function getSubscriptions()
    {
        return $this->optionsRequest(self::PATH);
    }
}