<?php

namespace spec\TradeDataServices\Common\Classes;

use TradeDataServices\Common\Classes\MiddleName;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MiddleNameSpec extends AbstractStringValueObjectSpec
{
    function it_is_initializable()
    {
        parent::initialize(MiddleName::class);
    }
}
