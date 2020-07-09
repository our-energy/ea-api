<?php

namespace OurEnergy\Emi\Icp;

use OurEnergy\Emi\BaseFactory;

class ComponentFactory extends BaseFactory
{
    protected static $fieldMap = [
        "ComponentType" => "componentType",
        "MeteringComponentSerialNumber" => "serialNumber",
        "MeterType" => "meterType",
        "AMIFlag" => "amiFlag",
        "CompensationFactor" => "compensationFactor",
        "ChannelInformation" => "channelInformation"
    ];

    /**
     * @param array $data
     *
     * @return Component
     */
    public static function create(array $data): Component
    {
        $data = self::transformKeys($data);

        return self::hydrate(new Component(), $data);
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return array|mixed|string
     */
    protected static function transformField(string $key, $value)
    {
        switch ($key) {
            case "channelInformation":
                return ChannelFactory::collection($value);
        }

        return $value;
    }
}
