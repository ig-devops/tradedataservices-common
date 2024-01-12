<?php

namespace TradeDataServices\Common\Interfaces;

use TradeDataServices\Common\Interfaces\EventDispatcher;

interface IsEventDispatcherAware
{
    /**
     * @return EventDispatcher
     */
    public function addEventDispatcher(EventDispatcher $eventDispatcher);
}
