<?php

namespace spec\TradeDataServices\Common\Classes;

use Faker\Factory;
use InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use stdClass;
use TradeDataServices\Common\Abstracts\StringValueObject;
use TradeDataServices\Common\Classes\FirstName;
use TradeDataServices\Common\Interfaces\ValueObject;

abstract class AbstractStringValueObjectSpec extends ObjectBehavior
{

    private $value;


    function let()
    {
        $this->value = Factory::create()->name;
        $this->beConstructedThrough('create', [$this->value]);

    }


    function initialize($class)
    {
        $this->shouldHaveType($class);
        $this->shouldHaveType(ValueObject::class);
        $this->shouldHaveType(StringValueObject::class);

    }


    function it_has_value()
    {
        $this->__toString()->shouldReturn($this->value);
        $this->value()->shouldReturn($this->value);

    }


    function it_throws_InvalidArgumentException()
    {
        $invalidArguments = [
            [],
            null,
            false,
            0,
            -1,
            new stdClass()
        ];
        foreach ($invalidArguments as $invalidArgument) {
            $this->shouldThrow(InvalidArgumentException::class)
                ->during('create', [$invalidArgument]);
        }

    }
}
