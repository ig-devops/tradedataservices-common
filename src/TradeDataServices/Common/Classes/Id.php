<?php

namespace TradeDataServices\Common\Classes;

use TradeDataServices\Common\Interfaces\ValueObject;

class Id implements ValueObject
{
    /**
     *
     * @var mixed
     */
    private $value;


    private function __construct($value)
    {
        $this->value = $value;
    }


    public static function create($value)
    {
        return new self($value);
    }


    public function value()
    {
        return $this->value;
    }


    public function __toString()
    {
        return $this->value();
    }


    public function equals($value)
    {
        return $this->value === $value;
    }
}
