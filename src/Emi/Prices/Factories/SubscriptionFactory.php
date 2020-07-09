<?php


namespace OurEnergy\Emi\Prices\Factories;

use DateTime;
use DateTimeZone;
use Exception;
use OurEnergy\Emi\BaseFactory;
use OurEnergy\Emi\Prices\Subscription;

class SubscriptionFactory extends BaseFactory
{
    protected static $fieldMap = [
        "DataType" => "type",
        "SubscribedUrl" => "url",
        "SubscribedAs" => "name",
        "SubscribedDate" => "date"
    ];

    /**
     * @param array $data
     *
     * @return Subscription
     */
    public static function create(array $data): Subscription
    {
        $data = self::transformKeys($data);

        return self::hydrate(new Subscription(), $data);
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return bool|DateTime|mixed|string
     * @throws Exception
     */
    protected static function transformField(string $key, $value)
    {
        switch ($key) {
            case "date":
                return new DateTime($value, new DateTimeZone(self::TIMEZONE));
        }

        return $value;
    }
}
