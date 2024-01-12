<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PhpSpec\Exception\Example\PendingException;
use PHPUnit\Framework\TestCase;
use TradeDataServices\Common\Interfaces\Command;
use TradeDataServices\Common\Interfaces\Handler;
use TradeDataServices\Common\Interfaces\Event;

/**
 * Defines application features from the specific context.
 */
class CommandHandlerEventContext extends FeatureContext implements Context
{

    /**
     *
     * @var Command
     */
    protected $command;

    /**
     *
     * @var Handler
     */
    protected $handler;

    /**
     *
     * @var Event
     */
    protected $event;


    /**
     * @Given I have a Command
     */
    public function iHaveACommand()
    {
        $this->command = new FakeCommand();
        TestCase::assertInstanceOf(Command::class, $this->command);

    }


    /**
     * @Given I have a Handler
     */
    public function iHaveAHandler()
    {
        $this->handler = new FakeCommandHandler;
        TestCase::assertInstanceOf(Handler::class, $this->handler);

    }


    /**
     * @When I pass the Command to the Handler
     */
    public function iPassTheCommandToTheHandler()
    {
        $this->event = $this->handler->handle($this->command);

    }


    /**
     * @Then I should receive an Event
     */
    public function iShouldReceiveAnEvent()
    {
        TestCase::assertInstanceOf(Event::class, $this->event);

    }
}

