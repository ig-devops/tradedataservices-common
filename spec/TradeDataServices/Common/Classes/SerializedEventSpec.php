<?php

namespace spec\TradeDataServices\Common\Classes;

use DateTimeImmutable;
use Faker\Factory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TradeDataServices\Common\Classes\Id;
use TradeDataServices\Common\Classes\SerializedEvent;
use TradeDataServices\Common\Interfaces\Event;
use TradeDataServices\Common\Interfaces\EventSerializer;

class SerializedEventSpec extends ObjectBehavior
{

    /**
     *
     * @var Id
     */
    private $id;

    /**
     *
     * @var string
     */
    private $eventName;

    /**
     *
     * @var DateTimeImmutable
     */
    private $occuredOn;

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

    /**
     *
     * @var EventSerializer
     */
    private $serializer;


    function let(Id $id, Event $event, EventSerializer $serializer)
    {
        $this->serializer      = $serializer;
        $this->id              = Factory::create()->uuid;
        $this->eventName       = Factory::create()->name;
        $this->occuredOn       = new \DateTimeImmutable;
        $this->event           = $event;
        $this->serializedEvent = \serialize($this->event);
        $this->serializer->serialize($this->event)->shouldBeCalled()->willReturn($this->serializedEvent);
        $this->beConstructedThrough('create', [$this->serializer, $this->event]);

    }


    function it_is_initializable()
    {
        $this->shouldHaveType(SerializedEvent::class);

    }


    function it_has_Id(Id $id)
    {
        $id->value()->shouldBeCalled()->willReturn($this->id);
        $this->event->id()->shouldBeCalled()->willReturn($id);
        $this->id()->shouldReturn($this->id);

    }


    function it_has_Name()
    {
        $this->event->name()->shouldBeCalled()->willReturn($this->eventName);
        $this->name()->shouldReturn($this->eventName);

    }


    function it_has_Date_Occured()
    {
        $this->event->occuredOn()->shouldBeCalled()->willReturn($this->occuredOn);
        $this->occuredOn()->shouldReturn($this->occuredOn);

    }


    function it_has_Payload()
    {
        $this->payload()->shouldReturn($this->serializedEvent);

    }
}
