<?php

namespace TradeDataServices\Common\Interfaces;

interface IsEventRecorderAware
{
    public function addEventRecorder(EventRecorder $eventRecorder);

}
