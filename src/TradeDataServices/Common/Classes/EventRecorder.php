<?php

namespace TradeDataServices\Common\Classes;

use TradeDataServices\Common\Interfaces\EventDispatcher as EventDispatcherInterface;
use TradeDataServices\Common\Interfaces\EventRecorder as EventRecorderInterface;
use TradeDataServices\Common\Interfaces\EventSerializer;
use TradeDataServices\Common\Repository\EventRepository;

class EventRecorder implements EventRecorderInterface
{

    /**
     *
     * @var EventRepository
     */
    private $eventRepository;

    /**
     *
     * @var EventSerializer
     */
    private $serializer;


    private function __construct(EventRepository $eventRepository, EventSerializer $serializer)
    {
        $this->eventRepository = $eventRepository;
        $this->serializer      = $serializer;

    }


    public static function create(EventRepository $eventRepository, EventSerializer $serializer)
    {
        $eventRecorder = new EventRecorder($eventRepository, $serializer);

        return $eventRecorder;

    }


    public function storeDispatcherRecordedEvents(EventDispatcherInterface $eventDispatcher)
    {
        if (count($eventDispatcher->getRecordedEvents()) > 0) {
            foreach ($eventDispatcher->getRecordedEvents() as $event) {
                self::storeEvent($event);
            }
        }

    }


    private function storeEvent($event)
    {
        $serializedEvent = SerializedEvent::create($this->serializer, $event);
        $this->eventRepository->store($serializedEvent);

    }
}
