<?php

namespace EMI\Prices;

use DateTime;

/**
 * Represents a 5-minute price from the API
 *
 * @property-read DateTime interval
 * @property-read string interval_datetime
 * @property-read int five_min_period
 * @property-read bool is_daylight_savings
 * @property-read double load
 * @property-read double generation
 * @property-read double price
 */
class PriceResult
{
    /**
     * @var array
     */
    private static $fieldMap = [
        'isDayLightSavingHR' => 'is_daylight_savings',
        'pnode' => 'grid_point'
    ];

    /**
     * @var DateTime
     */
    public $interval;

    /**
     * @var string
     */
    public $interval_datetime;

    /**
     * @var int
     */
    public $five_min_period;

    /**
     * @var bool
     */
    public $is_daylight_savings;

    /**
     * @var double
     */
    public $load;

    /**
     * @var double
     */
    public $generation;

    /**
     * @var double
     */
    public $price;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (isset(self::$fieldMap[$key])) {
                $key = self::$fieldMap[$key];
            }

            $this->$key = $value;
        }

        try {
            $this->interval = new DateTime($this->interval_datetime);
        } catch (\Exception $e) {
            $this->interval = null;
        }
    }
}