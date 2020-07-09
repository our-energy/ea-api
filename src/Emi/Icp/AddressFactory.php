<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp;

use OurEnergy\Emi\BaseFactory;

class AddressFactory extends BaseFactory
{
    protected static $fieldMap = [
        "PropertyNameOrDescription" => "nameOrDescription",
        "PhysicalAddressUnit" => "unit",
        "PhysicalAddressNumber" => "number",
        "PhysicalAddressStreet" => "street",
        "PhysicalAddressSuburb" => "suburb",
        "PhysicalAddressTown" => "town",
        "PhysicalAddressRegion" => "region",
        "PhysicalAddressPostCode" => "postCode",
        "GPS_Easting" => "gpsEasting",
        "GPS_Northing" => "gpsNorthing",
    ];

    /**
     * @param array $data
     *
     * @return Address
     */
    public static function create(array $data): Address
    {
        $data = self::transformKeys($data);

        return self::hydrate(new Address(), $data);
    }

    /**
     * @inheritDoc
     */
    protected static function transformField(string $key, $value)
    {
        switch ($key) {
            case "postCode":
            case "gpsEasting":
            case "gpsNorthing":
                return (string)$value;
        }

        return $value;
    }
}
