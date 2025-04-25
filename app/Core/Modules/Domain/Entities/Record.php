<?php

namespace App\Core\Modules\Domain\Entities;


/**
 * [Description Record]
 */
class Record
{

    /**
     * @var array<string,mixed>
     */
    private $attributes;

    /**
     * @var string
     */
    private $source;

    public function __construct() {}

    public function setAttribute(string $key, $value = null)
    {
        if (is_numeric($key)) {
            throw new \InvalidArgumentException("$key should a string value");
        }

        $this->attributes[$key] = $value;
    }

    public function setAttributes(array $attributes)
    {
        array_walk(
            $attributes,
            fn($value, $attribute) => $this->setAttribute($attribute, $value)
        );
    }
}
