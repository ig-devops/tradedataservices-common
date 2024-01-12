<?php

namespace TradeDataServices\Common\Classes;

use TradeDataServices\Common\Abstracts\StringValueObject;
use TradeDataServices\Common\Interfaces\ValueObject;

class LastName extends StringValueObject implements ValueObject
{


    protected function __construct($value)
    {
        parent::__construct($value);
    }


    public static function create($value)
    {
        return new self($value);
    }
}
