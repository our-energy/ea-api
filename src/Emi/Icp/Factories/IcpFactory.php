<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp\Factories;

use OurEnergy\Emi\BaseFactory;
use OurEnergy\Emi\Icp\Icp;

class IcpFactory extends BaseFactory
{
    protected static $fieldMap = [
        "ICPIdentifier" => "identifier",
        "ICPStatus" => "status",
        "Address" => "address",
        "Network" => "network",
        "Pricing" => "pricing",
        "Trader" => "trader",
        "Metering" => "metering"
    ];

    /**
     * @param array $data
     *
     * @return Icp
     */
    public static function create(array $data): Icp
    {
        $data = self::transformKeys($data);

        return self::hydrate(new Icp(), $data);
    }

    /**
     * @param string $key
     * @param $value
     *
     * @return mixed
     */
    protected static function transformField(string $key, $value)
    {
        switch ($key) {
            case "address":
                return AddressFactory::create($value);

            case "network":
                return NetworkFactory::create($value);

            case "pricing":
                return PricingFactory::create($value);

            case "trader":
                return TraderFactory::create($value);

            case "metering":
                return MeteringFactory::create($value);
        }

        return $value;
    }
}
