<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Prices\Factories;

use DateTime;
use DateTimeZone;
use Exception;
use OurEnergy\Emi\BaseFactory;
use OurEnergy\Emi\Prices\Price;

class PriceFactory extends BaseFactory
{
    protected static $fieldMap = [
        'interval_datetime' => 'interval',
        'five_min_period' => 'fiveMinutePeriod',
        'isDayLightSavingHR' => 'isDaylightSavingsHour',
        'pnode' => 'node',
        'load' => 'load',
        'generation' => 'generation',
        'price' => 'price'
    ];

    /**
     * @param array $data
     *
     * @return Price
     * @throws Exception
     */
    public static function create(array $data): Price
    {
        $data = self::transformKeys($data);

        return self::hydrate(new Price(), $data);
    }

    /**
     * @param string $key
     * @param $value
     *
     * @return mixed
     * @throws Exception
     */
    protected static function transformField(string $key, $value)
    {
        switch ($key) {
            case "interval":
                return new DateTime($value, new DateTimeZone(self::TIMEZONE));

            case "isDaylightSavingsHour":
                return $value === 1;
        }

        return $value;
    }
}
