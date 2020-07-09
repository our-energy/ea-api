<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp;

use OurEnergy\Emi\BaseFactory;

class MeteringFactory extends BaseFactory
{
    protected static $fieldMap = [
        "MeteringEquipmentProviderParticipantID" => "participantID",
        "MeteringEquipmentProviderParticipantName" => "participantName",
        "InstallationInformation" => "installationInformation"
    ];

    /**
     * @param array $data
     *
     * @return Metering
     */
    public static function create(array $data): Metering
    {
        $data = self::transformKeys($data);

        return self::hydrate(new Metering(), $data);
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
            case "installationInformation":
                return InstallationFactory::collection($value);
        }

        return $value;
    }
}
