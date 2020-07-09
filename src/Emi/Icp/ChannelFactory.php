<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp;

use OurEnergy\Emi\BaseFactory;

class ChannelFactory extends BaseFactory
{
    protected static $fieldMap = [
        "MeteringComponentSerialNumber" => "serialNumber",
        "ChannelNumber" => "channelNumber",
        "RegisterContentCode" => "registerContentCode",
        "PeriodOfAvailability" => "periodOfAvailability",
        "UnitOfMeasurement" => "unitOfMeasurement",
        "EnergyFlowDirection" => "energyFlowDirection",
        "AccumulatorType" => "accumulatorType",
        "SwitchReadIndicator" => "switchReadIndicator"
    ];

    /**
     * @param array $data
     *
     * @return Channel
     */
    public static function create(array $data): Channel
    {
        $data = self::transformKeys($data);

        return self::hydrate(new Channel(), $data);
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     */
    protected static function transformField(string $key, $value)
    {
        switch ($key) {
            case "periodOfAvailability":
                return (int)$value;
        }

        return $value;
    }
}
