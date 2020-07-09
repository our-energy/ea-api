<?php

namespace OurEnergy\Emi\Icp\Factories;

use OurEnergy\Emi\BaseFactory;
use OurEnergy\Emi\Icp\Pricing;

class PricingFactory extends BaseFactory
{
    protected static $fieldMap = [
        "DistributorPriceCategoryCode" => "priceCategoryCode",
        "DistributorLossCategoryCode" => "lossCategoryCode",
        "ChargeableCapacity" => "chargeableCapacity",
        "DistributorInstallationDetails" => "installationDetails"
    ];

    /**
     * @param array $data
     *
     * @return Pricing
     */
    static function create(array $data): Pricing
    {
        $data = self::transformKeys($data);

        return self::hydrate(new Pricing(), $data);
    }
}
