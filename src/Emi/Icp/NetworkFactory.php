<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp;

use DateTime;
use DateTimeZone;
use Exception;
use OurEnergy\Emi\BaseFactory;

class NetworkFactory extends BaseFactory
{
    protected static $fieldMap = [
        "NetworkParticipantID" => "participantId",
        "NetworkParticipantName" => "participantName",
        "POC" => "poc",
        "ReconciliationType" => "reconciliationType",
        "InitialElectricallyConnectedDate" => "initialElectricallyConnectedDate",
        "GenerationCapacity" => "generationCapacity",
        "FuelType" => "fuelType",
        "DirectBilledStatus" => "directBilledStatus",
    ];

    /**
     * @param array $data
     *
     * @return Network
     */
    public static function create(array $data): Network
    {
        $data = self::transformKeys($data);

        return self::hydrate(new Network(), $data);
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return mixed
     * @throws Exception
     */
    protected static function transformField(string $key, $value)
    {
        switch ($key) {
            case "initialElectricallyConnectedDate":
                return new DateTime($value, new DateTimeZone(self::TIMEZONE));
        }

        return $value;
    }
}
