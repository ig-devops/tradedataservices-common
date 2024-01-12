<?php

namespace spec\TradeDataServices\Common\Classes;

use PhpSpec\ObjectBehavior;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use TradeDataServices\Common\Classes\EventDispatcher;
use TradeDataServices\Common\Interfaces\Command;
use TradeDataServices\Common\Interfaces\Event;
use TradeDataServices\Common\Interfaces\EventListener;
use TradeDataServices\Common\Interfaces\EventDispatcher as EventDispatcherInterface;

class EventDispatcherSpec extends ObjectBehavior
{


    function let()
    {
        $this->beConstructedThrough('create');

    }


    function it_is_initializable()
    {
        $this->shouldHaveType(EventDispatcher::class);
        $this->shouldHaveType(EventDispatcherInterface::class);

    }


    function it_attaches_Listeners()
    {
        $listener1 = new FakeDomainEventListener1;
        $listener2 = new FakeDomainEventListener2;
        $listener3 = new FakeDomainEventListener3;
        $listener4 = new FakeDomainEventListener4;
        $this->attachListener($listener1)->shouldReturn($this);
        $this->attachListener($listener2)->shouldHaveType($this);
        $this->attachListener($listener3)->shouldHaveType($this);
        $this->attachListener($listener4)->shouldHaveType($this);
        $this->numberOfListeners()->shouldBe(4);

    }


    function it_detaches_Listeners()
    {
        $listener1 = new FakeDomainEventListener1;
        $listener2 = new FakeDomainEventListener2;
        $listener3 = new FakeDomainEventListener3;
        $listener4 = new FakeDomainEventListener4;
        $this->attachListener($listener1)->shouldReturn($this);
        $this->attachListener($listener2)->shouldHaveType($this);
        $this->attachListener($listener3)->shouldHaveType($this);
        $this->attachListener($listener4)->shouldHaveType($this);

        $this->removeListener($listener1)->shouldReturn($this);
        $this->removeListener($listener2)->shouldHaveType($this);
        $this->numberOfListeners()->shouldBe(2);

    }


    function it_ignores_non_existing_Listeners()
    {
        $listener1 = new FakeDomainEventListener1;
        $this->removeListener($listener1)->shouldReturn($this);

    }


    function it_ignores_duplicate_Listeners()
    {
        $listener1 = new FakeDomainEventListener1;
        $listener2 = new FakeDomainEventListener2;
        $listener3 = new FakeDomainEventListener3;
        $listener4 = new FakeDomainEventListener4;
        $listener5 = new IgnoredFakeDomainEventListener;
        $this->attachListener($listener1);
        $this->attachListener($listener2);
        $this->attachListener($listener3);
        $this->attachListener($listener4);
        $this->attachListener($listener5);
        $this->attachListener($listener5);
        $this->attachListener($listener5);
        $this->attachListener($listener5);
        $this->attachListener($listener5);
        $this->attachListener($listener5);
        $this->attachListener($listener5);
        $this->attachListener($listener5);
        $this->numberOfListeners()->shouldBe(5);

    }


    function it_notifies_Listeners(Command $command)
    {
        $event     = new FakeEvent($command->getWrappedObject());
        $listener1 = new FakeDomainEventListener1;
        $listener2 = new FakeDomainEventListener2;
        $listener3 = new FakeDomainEventListener3;
        $listener4 = new FakeDomainEventListener4;
        $listener5 = new IgnoredFakeDomainEventListener;
        $this->attachListener($listener1);
        $this->attachListener($listener2);
        $this->attachListener($listener3);
        $this->attachListener($listener4);
        $this->attachListener($listener5);
        $this->dispatch($event);

        TestCase::assertTrue($listener1->isNotified());
        TestCase::assertTrue($listener2->isNotified());
        TestCase::assertTrue($listener3->isNotified());
        TestCase::assertTrue($listener4->isNotified());
        TestCase::assertFalse($listener5->isNotified());

    }


    function it_returns_Dispatched_Events(Command $command)
    {
        $ctr = rand(1, 10);
        for ($x = 0; $x < $ctr; $x++) {
            $event = new FakeEvent($command->getWrappedObject());
            $this->dispatch($event);
        }
        TestCase::assertEquals($ctr, count($this->getRecordedEvents()->getWrappedObject()));

    }


    function it_clears_Events(Command $command)
    {
        $ctr = rand(1, 10);
        for ($x = 0; $x < $ctr; $x++) {
            $event = new FakeEvent($command->getWrappedObject());
            $this->dispatch($event);
        }

        $this->clearRecordedEvents();
        TestCase::assertEquals(0, count($this->getRecordedEvents()->getWrappedObject()));

    }
}

class FakeDomainEventListener1 implements EventListener
{

    private $isNotified = false;


    public function isNotified()
    {
        return $this->isNotified;

    }


    public function notify(Event $event)
    {
        return $this->isNotified = true;

    }


    public static function eventsSubscribedTo()
    {
        return [FakeEvent::class];

    }
}

class FakeDomainEventListener2 implements EventListener
{

    private $isNotified = false;


    public function isNotified()
    {
        return $this->isNotified;

    }


    public function notify(Event $event)
    {
        return $this->isNotified = true;

    }


    public static function eventsSubscribedTo()
    {
        return [FakeEvent::class];

    }
}

class FakeDomainEventListener3 implements EventListener
{

    private $isNotified = false;


    public function isNotified()
    {
        return $this->isNotified;

    }


    public function notify(Event $event)
    {
        return $this->isNotified = true;

    }


    public static function eventsSubscribedTo()
    {
        return [FakeEvent::class];

    }
}

class FakeDomainEventListener4 implements EventListener
{

    private $isNotified = false;


    public function isNotified()
    {
        return $this->isNotified;

    }


    public function notify(Event $event)
    {
        return $this->isNotified = true;

    }


    public static function eventsSubscribedTo()
    {
        return [FakeEvent::class, AnotherFakeEvent::class];

    }
}

class IgnoredFakeDomainEventListener implements EventListener
{

    private $isNotified = false;


    public function isNotified()
    {
        return $this->isNotified;

    }


    public function notify(Event $event)
    {
        return $this->isNotified = true;

    }


    public static function eventsSubscribedTo()
    {
        return [AnotherFakeEvent::class];

    }
}

class FakeEvent implements Event
{

    private $command;


    public function __construct(Command $command)
    {
        $this->command = $command;

    }


    public function getCommand()
    {
        return $this->command;

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

class AnotherFakeEvent implements Event
{

    private $command;


    public function __construct(Command $command)
    {
        $this->command = $command;

    }


    public function getCommand()
    {
        return $this->command;

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
