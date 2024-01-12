<?php

namespace spec\TradeDataServices\Common\Classes;

error_reporting(E_ALL);

use Faker\Factory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TradeDataServices\Common\Abstracts\StringValueObject;
use TradeDataServices\Common\Classes\FirstName;
use TradeDataServices\Common\Classes\FullName;
use TradeDataServices\Common\Classes\LastName;
use TradeDataServices\Common\Classes\MiddleName;
use TradeDataServices\Common\Interfaces\ValueObject;

class FullNameSpec extends ObjectBehavior
{

    /**
     *
     * @var FirstName
     */
    private $firstName;

    /**
     *
     * @var LastName
     */
    private $lastName;

    /**
     *
     * @var MiddleName
     */
    private $middleName;


    function let(FirstName $firstName, LastName $lastName, MiddleName $middleName)
    {
        $this->firstName  = $firstName;
        $this->lastName   = $lastName;
        $this->middleName = $middleName;
        $this->beConstructedThrough('create', [$firstName, $lastName]);

    }


    function it_is_initializable()
    {
        $this->shouldHaveType(FullName::class);
        $this->shouldHaveType(ValueObject::class);
        $this->shouldHaveType(StringValueObject::class);

    }


    function it_has_value()
    {
        $seeder    = Factory::create();
        $firstName = $seeder->firstName;
        $lastName  = $seeder->lastName;
        $fullName  = $firstName . ' ' . $lastName;

        $this->firstName->value()->shouldBeCalled()->willReturn($firstName);
        $this->lastName->value()->shouldBeCalled()->willReturn($lastName);

        $this->__toString()->shouldReturn($fullName);
        $this->value()->shouldReturn($fullName);

    }


    function it_has_FirstName()
    {
        $seeder    = Factory::create();
        $firstName = $seeder->firstName;
        $this->firstName->value()->shouldBeCalled()->willReturn($firstName);
        $this->firstName()->shouldReturn($firstName);

    }


    function it_has_LastName()
    {
        $seeder   = Factory::create();
        $lastName = $seeder->lastName;
        $this->lastName->value()->shouldBeCalled()->willReturn($lastName);
        $this->lastName()->shouldReturn($lastName);

    }


    function it_has_MiddleName()
    {
        $seeder     = Factory::create();
        $middleName = $seeder->lastName;
        $this->middleName->value()->shouldBeCalled()->willReturn($middleName);
        $this->addMiddleName($this->middleName)->shouldReturn($this);
        $this->middleName()->shouldReturn($middleName);

    }

    function it_has_empty_MiddleName()
    {
        $this->middleName()->shouldReturn('');

    }
}
