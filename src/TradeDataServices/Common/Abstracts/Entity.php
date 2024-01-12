<?php

namespace TradeDataServices\Common\Abstracts;

use TradeDataServices\Common\Classes\Id;

abstract class Entity
{

    /**
     *
     * @var Id
     */
    private $id;


    protected function setId(Id $id)
    {
        $this->id = $id;
    }


    /**
     * @codingStandardsIgnoreStart
     */
    public function id()
    {
        /**
         * @codingStandardsIgnoreEnd
         */
        return $this->id;
    }
}
