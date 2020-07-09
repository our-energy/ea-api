<?php

declare(strict_types=1);

namespace OurEnergy\Emi\Icp\Factories;

use DateTime;
use DateTimeZone;
use Exception;
use OurEnergy\Emi\BaseFactory;
use OurEnergy\Emi\Icp\Installation;

class InstallationFactory extends BaseFactory
{
    protected static $fieldMap = [
        "MeteringInstallationCategory" => "category",
        "MeteringInstallationType" => "type",
        "CertificationExpiryDate" => "certificationExpiryDate",
        "ComponentInformation" => "componentInformation"
    ];

    /**
     * @param array $data
     *
     * @return Installation
     */
    public static function create(array $data): Installation
    {
        $data = self::transformKeys($data);

        return self::hydrate(new Installation(), $data);
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
            case "certificationExpiryDate":
                return new DateTime($value, new DateTimeZone(self::TIMEZONE));

            case "componentInformation":
                return ComponentFactory::collection($value);
        }

        return $value;
    }
}
