<?php

namespace spec\TradeDataServices\Common\Classes;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TradeDataServices\Common\Classes\EventDispatcher;
use TradeDataServices\Common\Classes\EventRecorder;
use TradeDataServices\Common\Classes\SerializedEvent;
use TradeDataServices\Common\Interfaces\Event;
use TradeDataServices\Common\Interfaces\EventRecorder as EventRecorderInterface;
use TradeDataServices\Common\Interfaces\EventSerializer;
use TradeDataServices\Common\Repository\EventRepository;

class EventRecorderSpec extends ObjectBehavior
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


    function let(EventRepository $eventRepository, EventSerializer $serializer)
    {
        $this->eventRepository = $eventRepository;
        $this->serializer      = $serializer;
        $this->beConstructedThrough('create', [$this->eventRepository, $this->serializer]);

    }


    function it_is_initializable()
    {
        $this->shouldHaveType(EventRecorder::class);
        $this->shouldHaveType(EventRecorderInterface::class);

    }


    function it_stores_Events(SerializedEvent $serializedEvent)
    {
        $eventDispatcher = EventDispatcher::create();
        $ctr             = rand(1, 10);
        $event           = new InMemoryEvent();

        for ($x = 0; $x < $ctr; $x++) {
            $eventDispatcher->dispatch($event);
        }

        $this->serializer->serialize($event)->shouldBeCalledTimes($ctr)->willReturn($serializedEvent);
        $this->eventRepository->store(Argument::type(SerializedEvent::class))->shouldBeCalledTimes($ctr);
        $this->storeDispatcherRecordedEvents($eventDispatcher);

    }
}

class InMemoryEvent implements Event
{


    public function id()
    {

    }


    public function name()
    {

    }


    public function occuredOn()
    {

    }


    public function getCommand()
    {

    }
}
