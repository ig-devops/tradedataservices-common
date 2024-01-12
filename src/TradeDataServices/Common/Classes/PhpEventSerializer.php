<?php

namespace TradeDataServices\Common\Classes;

use TradeDataServices\Common\Interfaces\Event;
use TradeDataServices\Common\Interfaces\EventSerializer;

class PhpEventSerializer implements EventSerializer
{


    public function serialize(Event $event)
    {
        return \serialize($event);

    }


    public function unserialize($serializedEventString)
    {
        return \unserialize($serializedEventString);

    }
}
