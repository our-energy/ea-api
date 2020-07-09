<?php

declare(strict_types=1);

namespace OurEnergy\Emi;

abstract class BaseFactory
{
    // Dates will always be in New Zealand time
    const TIMEZONE = "Pacific/Auckland";

    /** @var array */
    protected static $fieldMap = [];

    abstract static function create(array $data);

    public static function collection(array $items): array
    {
        $collection = [];

        foreach ($items as $data) {
            $collection[] = static::create($data);
        }

        return $collection;
    }

    /**
     * @param $instance
     * @param array $data
     *
     * @return mixed
     */
    protected static function hydrate($instance, array $data)
    {
        foreach ($data as $key => $value) {
            $method = "set" . ucfirst($key);

            $value = static::transformField($key, $value);

            if (method_exists($instance, $method)) {
                $instance->$method($value);
            }
        }

        return $instance;
    }

    /**
     * @param string $key
     * @param mixed $value
     *
     * @return string
     */
    protected static function transformField(string $key, $value)
    {
        return $value;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected static function transformKeys(array $data): array
    {
        $transformed = [];

        foreach ($data as $key => $value) {
            if (!isset(static::$fieldMap[$key])) {
                continue;
            }

            $transformed[static::$fieldMap[$key]] = $value;
        }

        return $transformed;
    }
}
