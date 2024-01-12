<?php

namespace TradeDataServices\Common\Interfaces;

interface EventRecorder
{
    /**
     *
     * @param EventDispatcher $eventDispatcher
     */
    public function storeDispatcherRecordedEvents(EventDispatcher $eventDispatcher);
}
