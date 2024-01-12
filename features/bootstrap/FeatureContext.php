<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use TradeDataServices\Common\Classes\EventDispatcher;
use TradeDataServices\Common\Interfaces\Command;
use TradeDataServices\Common\Interfaces\Handler;
use TradeDataServices\Common\Interfaces\Event;
use TradeDataServices\Common\Interfaces\EventListener;
use TradeDataServices\Common\Interfaces\IsEventDispatcherAware;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{


    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {

    }
}

class FakeCommand implements Command
{

}

class FakeCommandHandler implements Handler
{


    public function handle(Command $command)
    {
        return new FakeEvent($command);

    }
}

class FakeEvent implements Event
{

    /**
     *
     * @var Command
     */
    private $command;


    public function __construct(Command $command)
    {
        $this->command = $command;

    }


    public function getCommand()
    {
        return $this->command;

    }
}

interface FakeDomainEventListener extends EventListener
{


    public function isNotified();
}

class FakeDomainEventListener1 implements FakeDomainEventListener
{

    private $isNotified = false;


    public static function eventsSubscribedTo()
    {
        return [
            FakeEvent::class
        ];

    }


    public function notify(Event $event)
    {
        $this->isNotified = true;

    }


    public function isNotified()
    {
        return $this->isNotified;

    }
}

class FakeDomainEventListener2 implements FakeDomainEventListener
{

    private $isNotified = false;


    public static function eventsSubscribedTo()
    {
        return [
            FakeEvent::class
        ];

    }


    public function notify(Event $event)
    {
        $this->isNotified = true;

    }


    public function isNotified()
    {
        return $this->isNotified;

    }
}

class IgnoredFakeEvent implements Event
{

    /**
     *
     * @var Command
     */
    private $command;


    public function __construct(Command $command)
    {
        $this->command = $command;

    }


    public function getCommand()
    {
        return $this->command;

    }
}

class IgnoredFakeDomainLlistener implements FakeDomainEventListener
{

    private $isNotified = false;


    public static function eventsSubscribedTo()
    {
        return [
            IgnoredFakeEvent::class
        ];

    }


    public function notify(Event $event)
    {
        $this->isNotified = true;

    }


    public function isNotified()
    {
        return $this->isNotified;

    }
}
