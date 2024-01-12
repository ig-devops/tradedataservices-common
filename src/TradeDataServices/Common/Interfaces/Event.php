<?php

namespace TradeDataServices\Common\Interfaces;

use DateTimeImmutable;
use TradeDataServices\Common\Classes\Id;

interface Event
{


    /**
     * @return Id
     */
    public function id();


    /**
     * @return string
     */
    public function name();


    /**
     * @return DateTimeImmutable
     */
    public function occuredOn();


    /**
     * @return Command
     */
    public function getCommand();
}
