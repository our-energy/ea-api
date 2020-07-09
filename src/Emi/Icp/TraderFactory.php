<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp;

use OurEnergy\Emi\BaseFactory;

class TraderFactory extends BaseFactory
{
    protected static $fieldMap = [
        "TraderSwitchInProgress" => "switchInProgress",
        "TraderParticipantID" => "participantId",
        "TraderParticipantName" => "participantName",
        "ProfileCode" => "profileCode",
        "ANZSICcode" => "anzsiCcode",
        "DailyUnmeteredkWh" => "dailyUnmeteredKwh",
        "UnmeteredLoadDetails" => "unmeteredLoadDetails"
    ];

    /**
     * @param array $data
     *
     * @return Trader
     */
    public static function create(array $data): Trader
    {
        $data = self::transformKeys($data);

        return self::hydrate(new Trader(), $data);
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return mixed|string
     */
    protected static function transformField(string $key, $value)
    {
        switch ($key) {
            case "switchInProgress":
                break;

            case "dailyUnmeteredKwh":
                return floatval($value);
        }

        return $value;
    }
}
