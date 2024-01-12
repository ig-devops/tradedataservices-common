<?php

namespace spec\TradeDataServices\Common\Classes;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TradeDataServices\Common\Classes\PhpEventSerializer;
use TradeDataServices\Common\Interfaces\Event;
use TradeDataServices\Common\Interfaces\EventSerializer;

class PhpEventSerializerSpec extends ObjectBehavior
{

    private $event;
    private $serialized   = '';


    function let()
    {
        $this->event        = new FakeUnserializedEvent();
        $this->serialized   = \serialize($this->event);

    }


    function it_is_initializable()
    {
        $this->shouldHaveType(PhpEventSerializer::class);
        $this->shouldHaveType(EventSerializer::class);

    }


    function it_Serializes_Event()
    {
        $this->serialize($this->event)->shouldReturn($this->serialized);

    }


    function it_Unserializes_Events()
    {
        $this->unserialize($this->serialized)->shouldHaveType($this->event);

    }
}

class FakeUnserializedEvent implements Event
{


    public function getCommand()
    {

    }


    public function id()
    {

    }


    public function name()
    {

    }


    public function occuredOn()
    {

    }
}
