<?php

namespace EMI\ICP;

/**
 * Represents an ICP object from the API response
 *
 * @package EMI\ICP
 */
class ICPResult
{
    /** @var string */
    public $identifier;

    /** @var string */
    public $status;

    /** @var array */
    public $address;

    /** @var array */
    public $network;

    /** @var array */
    public $pricing;

    /** @var array */
    public $trader;

    /** @var array */
    public $metering;

    /**
     * Map fields to camel case and rename for clarity
     *
     * @var array
     */
    private static $fieldMap = [
        'ICPIdentifier' => 'identifier',
        'ICPStatus' => 'status',
        'Address' => 'address',
        'Network' => 'network',
        'Pricing' => 'pricing',
        'Trader' => 'trader',
        'Metering' => 'metering'
    ];

    /**
     * ICPResult constructor.
     *
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
    }
}
