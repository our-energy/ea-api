<?php

namespace EMI\Prices;

use DateTime;

/**
 * Represents a 5-minute price from the API
 *
 * @package EMI\Prices
 */
class PriceResult
{
    /**
     * Map fields to camel case and rename for clarity
     *
     * @var array
     */
    private static $fieldMap = [
        'interval_datetime' => 'interval',
        'isDayLightSavingHR' => 'isDaylightSavings',
        'pnode' => 'gridPoint',
        'five_min_period' => 'fiveMinutePeriod',
        'Runtime' => 'runtime'
    ];

    /**
     * @var DateTime
     */
    public $runtime;

    /**
     * @var DateTime
     */
    public $interval;

    /**
     * @var string
     */
    public $gridPoint;

    /**
     * @var int
     */
    public $fiveMinutePeriod;

    /**
     * @var bool
     */
    public $isDaylightSavings;

    /**
     * @var float
     */
    public $load;

    /**
     * @var float
     */
    public $generation;

    /**
     * @var float
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
            $this->interval = new DateTime($this->interval);
        } catch (\Exception $e) {
            $this->interval = null;
        }

        if (!is_null($this->runtime)) {
            try {
                $this->runtime = new DateTime($this->runtime);
            } catch (\Exception $e) {
            }
        }
    }
}
