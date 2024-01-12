<?php

namespace TradeDataServices\Common\Interfaces;

interface ValueObject
{


    /**
     * @return mixed
     */
    public function value();


    /**
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function equals($value);
}
