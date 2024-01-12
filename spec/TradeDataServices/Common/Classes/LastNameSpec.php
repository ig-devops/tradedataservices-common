<?php

namespace spec\TradeDataServices\Common\Classes;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TradeDataServices\Common\Classes\LastName;

class LastNameSpec extends AbstractStringValueObjectSpec
{
    function it_is_initializable()
    {
        parent::initialize(LastName::class);
    }
}
