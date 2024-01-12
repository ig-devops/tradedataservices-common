<?php

namespace TradeDataServices\Common\Interfaces;

interface EventDispatcher
{


    /**
     *
     * @param EventListener $listener
     */
    public function attachListener(EventListener $listener);


    /**
     * @param string $eventName
     * @param EventListener $listener
     */
    public function removeListener(EventListener $listener);


    /**
     *
     * @return int
     */
    public function numberOfListeners();


    /**
     *
     * @param Event $event
     */
    public function dispatch(Event $event);


    /**
     *
     * @return Event[]
     */
    public function getRecordedEvents();


    /**
     * @return null;
     */
    public function clearRecordedEvents();
}
