<?php

namespace TradeDataServices\Common\Abstracts;

use InvalidArgumentException;

abstract class StringValueObject extends ValueObject
{

    protected function __construct($value)
    {
        if (is_string($value) === false) {
            throw new InvalidArgumentException("Value is expected to be a String type");
        }
        parent::setValue(trim((string) $value));
    }


    public function __toString()
    {
        return parent::value();
    }
}
