<?php

namespace TradeDataServices\Common\Repository;

use TradeDataServices\Common\Classes\SerializedEvent;

interface EventRepository
{
    public function store(SerializedEvent $event);
}
