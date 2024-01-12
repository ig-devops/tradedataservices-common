<?php

namespace TradeDataServices\Common\Classes;

use DateTimeImmutable;
use TradeDataServices\Common\Interfaces\Event;
use TradeDataServices\Common\Interfaces\EventSerializer;

class SerializedEvent
{

    /**
     *
     * @var string
     */
    private $serializedEvent;

    /**
     *
     * @var Event
     */
    private $event;


    private function __construct(EventSerializer $serializer, Event $event)
    {
        $this->event           = $event;
        $this->serializedEvent = $serializer->serialize($event);

    }


    public static function create(EventSerializer $serializer, Event $event)
    {
        $serializedEvent = new SerializedEvent($serializer, $event);
        return $serializedEvent;

    }


    public function id()
    {
        return $this->event->id()->value();

    }


    public function name()
    {
        return $this->event->name();

    }


    public function occuredOn()
    {
        return $this->event->occuredOn();

    }


    public function payload()
    {
        return $this->serializedEvent;

    }
}
