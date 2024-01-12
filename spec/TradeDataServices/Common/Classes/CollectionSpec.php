<?php

namespace spec\TradeDataServices\Common\Classes;

use Countable;
use Iterator;
use PhpSpec\ObjectBehavior;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use stdClass;
use TradeDataServices\Common\Classes\Collection;

class CollectionSpec extends ObjectBehavior
{


    function it_is_initializable()
    {
        $this->shouldHaveType(Collection::class);
        $this->shouldHaveType(Iterator::class);
        $this->shouldHaveType(Countable::class);

    }


    function it_can_add_items()
    {
        $limit = rand(5, 20);
        for ($x = 0; $x < $limit; $x++) {
            $this->add(new stdClass())->shouldReturn($this);
        }

    }


    function it_can_count_items()
    {
        $limit = rand(5, 20);
        for ($x = 0; $x < $limit; $x++) {
            $this->add(new stdClass());
        }
        $this->count()->shouldReturn($limit);

    }


    function it_can_be_traversed()
    {
        $content = [ [], 'string', 1, true, false, new stdClass()];

        $limit = rand(5, 20);
        for ($x = 0; $x < $limit; $x++) {
            $contents[$x] = $content[rand(0, count($content) - 1)];
            $this->add($contents[$x]);
        }


        foreach ($this->getWrappedObject() as $x => $savedContent) {
            TestCase::assertEquals($contents[$x], $savedContent);
        }

    }
}
