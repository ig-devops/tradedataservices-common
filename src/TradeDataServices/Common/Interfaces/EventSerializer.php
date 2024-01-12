<?php

namespace TradeDataServices\Common\Interfaces;

interface EventSerializer
{
    /**
     *
     * @param Event $event
     *
     * @return string
     */
    public function serialize(Event $event);

    /**
     *
     * @param string $serializedEvent
     *
     * @return Event
     */
    public function unserialize($serializedEvent);
}
