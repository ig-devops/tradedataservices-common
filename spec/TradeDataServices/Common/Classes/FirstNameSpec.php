<?php

namespace spec\TradeDataServices\Common\Classes;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TradeDataServices\Common\Classes\FirstName;

class FirstNameSpec extends AbstractStringValueObjectSpec
{


    function it_is_initializable()
    {
        parent::initialize(FirstName::class);

    }
}
