<?php

namespace spec\TradeDataServices\Common\Classes;

use ArrayAccess;
use Iterator;
use IteratorAggregate;
use PhpSpec\ObjectBehavior;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use stdClass;
use TradeDataServices\Common\Classes\ArrayCollection;

class ArrayCollectionSpec extends ObjectBehavior
{

    private $elements;


    function it_is_initializable()
    {
        $this->shouldHaveType(ArrayCollection::class);
        $this->shouldHaveType(IteratorAggregate::class);
        $this->shouldHaveType(ArrayAccess::class);
        $this->isEmpty()->shouldReturn(true);

    }


    function it_can_be_Constructed_by_an_array()
    {
        $this->init_random_array_elements();

    }


    function it_can_be_Iterated()
    {
        $array = [
            'one'   => 'Isa',
            'two'   => 'Dalawa',
            'three' => 'Tatlo'
        ];
        $this->beConstructedWith($array);

        $this->shouldHaveKeyWithValue('one', 'Isa');
        $this->shouldHaveKeyWithValue('two', 'Dalawa');
        $this->shouldHaveKeyWithValue('three', 'Tatlo');
        $this->count()->shouldReturn(3);
        $this->toArray()->shouldReturn($array);
        $this->shouldHaveKey('one');
        $this->offsetExists('one');

        $this->first()->shouldReturn('Isa');
        $this->current()->shouldReturn('Isa');
        $this->next()->shouldReturn('Dalawa');
        $this->key()->shouldReturn('two');
        $this->last()->shouldReturn('Tatlo');
        $this->contains('Dalawa')->shouldReturn(true);
        $this->exists(function() { return true; })->shouldReturn(true);
        $this->exists(function() { return false; })->shouldReturn(false);
        $this->forAll(function() { return true; })->shouldReturn(true);
        $this->forAll(function() { return false; })->shouldReturn(false);
        $this->partition(function() { return true; })->shouldBeArray();
        $this->partition(function() { return false; })->shouldBeArray();
        $this->map(function() { return true; })->shouldHaveType(ArrayCollection::class);
        $this->map(function() { return false; })->shouldHaveType(ArrayCollection::class);
        $this->filter(function() { return true; })->shouldHaveType(ArrayCollection::class);
        $this->filter(function() { return false; })->shouldHaveType(ArrayCollection::class);
        $this->indexOf('Isa')->shouldReturn('one');
        $this->getIterator()->shouldHaveType(Iterator::class);
        $this->getValues()->shouldReturn(['Isa', 'Dalawa', 'Tatlo']);
        $this->getKeys()->shouldReturn(['one', 'two', 'three']);

        $this->slice(0,1)->shouldReturn(['one'   => 'Isa']);
        $this->set('four', 'Apat')->shouldReturn(null);
        $this->add('Lima')->shouldReturn(true);
        $this->remove('four')->shouldReturn('Apat');
        $this->remove('six')->shouldReturn(null);
        $this->removeElement('Lima')->shouldReturn(true);
        $this->removeElement('Anim')->shouldReturn(false);

        $this->offsetSet(null, 'Apat');
        $this->offsetSet('four', 'Apat');
        $this->offsetUnset('four');
        $this->__toString()->shouldBeString();

        $this->clear()->shouldReturn(null);
    }


    function it_can_be_Accessed_as_Array()
    {
        $this->beConstructedWith([
            'one'   => 'Isa',
            'two'   => 'Dalawa',
            'three' => 'Tatlo'
        ]);
        TestCase::assertEquals('Isa', $this->getWrappedObject()['one']);
        TestCase::assertEquals('Dalawa', $this->getWrappedObject()['two']);
        TestCase::assertEquals('Tatlo', $this->getWrappedObject()['three']);

    }


    private function init_random_array_elements()
    {
        $this->elements = [];
        $content        = [ [], 'string', 1, true, false, new stdClass()];
        $limit          = rand(5, 20);
        for ($x = 0; $x < $limit; $x++) {
            $this->elements[$x] = $content[rand(0, count($content) - 1)];
        }
        $this->beConstructedWith($this->elements);

    }
}
