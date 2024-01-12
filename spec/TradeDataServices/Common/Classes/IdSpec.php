<?php

namespace spec\TradeDataServices\Common\Classes;

use Faker\Factory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TradeDataServices\Common\Classes\Id;
use TradeDataServices\Common\Interfaces\ValueObject;

class IdSpec extends ObjectBehavior
{

    private $value;


    function let()
    {
        $this->value = Factory::create()->name;
        $this->beConstructedThrough('create', [$this->value]);

    }


    function it_is_initializable()
    {
        $this->shouldHaveType(Id::class);
        $this->shouldHaveType(ValueObject::class);

    }


    function it_has_value()
    {
        $this->__toString()->shouldReturn($this->value);
        $this->value()->shouldReturn($this->value);

    }
}
