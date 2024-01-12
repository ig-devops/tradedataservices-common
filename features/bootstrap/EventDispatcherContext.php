<?php

error_reporting(E_ALL);

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\TestCase;
use TradeDataServices\Common\Classes\EventDispatcher;
use TradeDataServices\Common\Classes\EventDispatchingHandler;
use TradeDataServices\Common\Interfaces\Handler;
use TradeDataServices\Common\Interfaces\EventListener;
use TradeDataServices\Common\Interfaces\IsEventDispatcherAware;

/**
 * Defines application features from the specific context.
 */
class EventDispatcherContext extends CommandHandlerEventContext implements Context
{

    /**
     *
     * @var EventDispatcher
     */
    protected $dispatcher;

    /**
     *
     * @var FakeEvent
     */
    protected $event;

    /**
     *
     * @var FakeDomainEventListener
     */
    protected $listeners;


    /**
     * @Given the Handler is aware of the Event Dispatcher
     */
    public function theHandlerIsAwareOfTheEventDispatcher()
    {
        $eventDispatcherAwareHandler = EventDispatchingHandler::create($this->dispatcher, $this->handler);
        $this->handler               = $eventDispatcherAwareHandler;
        TestCase::assertInstanceOf(Handler::class, $this->handler);
        TestCase::assertInstanceOf(IsEventDispatcherAware::class, $this->handler);

    }


    /**
     * @Given I have an Event Dispatcher
     */
    public function iHaveAnEventDispatcher()
    {
        $this->dispatcher = EventDispatcher::create();
        TestCase::assertInstanceOf(EventDispatcher::class, $this->dispatcher);

    }


    /**
     * @Given I have Event Listeners
     */
    public function iHaveEventListeners()
    {
        $this->listeners[] = new FakeDomainEventListener1;
        $this->listeners[] = new FakeDomainEventListener2;
        $this->listeners[] = new IgnoredFakeDomainLlistener;


        TestCase::assertInstanceOf(EventListener::class, $this->listeners[0]);
        TestCase::assertInstanceOf(EventListener::class, $this->listeners[1]);

    }


    /**
     * @Given the Event Listeners are subscribed to the Event
     */
    public function theEventListenersAreSubscribedToTheEvent()
    {
        $this->dispatcher->attachListener($this->listeners[0]);
        $this->dispatcher->attachListener($this->listeners[1]);
        $this->dispatcher->attachListener($this->listeners[2]);
        TestCase::assertEquals(count($this->listeners), $this->dispatcher->numberOfListeners());

    }


    /**
     * @Then the Event Listeners will be notified
     */
    public function theEventListenersWillBeNotified()
    {
        TestCase::assertTrue($this->listeners[0]->isNotified());
        TestCase::assertTrue($this->listeners[1]->isNotified());
        TestCase::assertFalse($this->listeners[2]->isNotified());

    }
}
