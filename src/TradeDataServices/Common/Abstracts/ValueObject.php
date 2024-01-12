<?php

namespace TradeDataServices\Common\Abstracts;

abstract class ValueObject
{

    private $value;


    protected function setValue($value)
    {
        $this->value = $value;
    }


    public function value()
    {
        return $this->value;
    }


    public function equals($value)
    {
        return $this->value === $value;
    }
}
