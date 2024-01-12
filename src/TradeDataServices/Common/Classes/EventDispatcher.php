<?php

namespace TradeDataServices\Common\Classes;

use TradeDataServices\Common\Interfaces\Event;
use TradeDataServices\Common\Interfaces\EventDispatcher as EventDispatcherInterface;
use TradeDataServices\Common\Interfaces\EventListener;

final class EventDispatcher implements EventDispatcherInterface
{


    private function __construct()
    {
    }


    public static function create()
    {
        return new self;
    }

    /**
     *
     * @var EventListener[]
     */
    private $listeners = [];

    /**
     *
     * @var Event[]
     */
    private $events;


    /**
     * @param EventListener $listener
     */
    public function attachListener(EventListener $listener)
    {
        if ($this->listenerExists($listener) === true) {
            return $this;
        }
        $this->listeners[] = $listener;
        return $this;
    }


    /**
     *
     * @param EventListener $listener
     *
     * @return boolean
     */
    private function listenerExists(EventListener $listener)
    {
        if ($this->hasListeners()) {
            foreach ($this->listeners as $attachedListener) {
                if ($listener === $attachedListener) {
                    return true;
                }
            }
        }
    }


    /**
     * @param string $eventName
     * @param EventListener $listener
     */
    public function removeListener(EventListener $listener)
    {
        if ($this->listenerExists($listener) !== true) {
            return $this;
        }

        return $this->detachListener($listener);
        ;
    }


    /**
     *
     * @return int
     */
    public function numberOfListeners()
    {
        return count($this->listeners);
    }


    /**
     *
     * @param string $eventName
     * @param EventListener $listener
     */
    private function detachListener(EventListener $listener)
    {
        foreach ($this->listeners as $index => $attachedListener) {
            if ($listener == $attachedListener) {
                unset($this->listeners[$index]);
            }
        }
        return $this;
    }


    /**
     *
     * @param string $eventName
     *
     * @return boolean
     */
    private function hasListeners()
    {
        return $this->numberOfListeners() > 0;
    }


    /**
     *
     * @param Event $event
     */
    public function dispatch(Event $event)
    {
        $this->events[] = $event;
        if ($this->hasListeners()) {
            foreach ($this->listeners as $listener) {
                foreach ($listener::eventsSubscribedTo() as $eventSubscribedTo) {
                    if ($eventSubscribedTo === get_class($event)) {
                        $listener->notify($event);
                    }
                }
            }
        }
    }


    /**
     *
     * @return Event[]
     */
    public function getRecordedEvents()
    {
        return $this->events;
    }

    /**
     * @return null
     */
    public function clearRecordedEvents()
    {
        $this->events = [];
    }
}
