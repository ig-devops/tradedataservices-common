<?php

namespace spec\TradeDataServices\Common\Classes;

use Faker\Factory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use TradeDataServices\Common\Classes\FirstName;
use TradeDataServices\Common\Classes\FullName;
use TradeDataServices\Common\Classes\FullNameFormatter;
use TradeDataServices\Common\Classes\LastName;
use TradeDataServices\Common\Classes\MiddleName;

class FullNameFormatterSpec extends ObjectBehavior
{

    /**
     *
     * @var FullName
     */
    private $fullName;


    function let(FullName $fullName)
    {
        $this->fullName = $fullName;
        $this->beConstructedWith($this->fullName);

    }


    function it_is_initializable()
    {
        $this->shouldHaveType(FullNameFormatter::class);

    }


    function it_formats_LastName_and_FirstName()
    {
        $seeder          = Factory::create();
        $firstNameString = $seeder->firstName;
        $lastNameString  = $seeder->lastName;
        $this->fullName->firstName()->shouldBeCalled()->willReturn($firstNameString);
        $this->fullName->lastName()->shouldBeCalled()->willReturn($lastNameString);
        $this->fullName->middleName()->shouldBeCalled()->willReturn(null);

        $this->lastNameFirstName()->shouldReturn($lastNameString . ' ' . $firstNameString);

    }



    function it_formats_FirstName_MiddleName_and_LastName()
    {
        $seeder           = Factory::create();
        $firstNameString  = $seeder->firstName;
        $lastNameString   = $seeder->lastName;
        $middleNameString = $seeder->lastName;
        $this->fullName->firstName()->shouldBeCalled()->willReturn($firstNameString);
        $this->fullName->lastName()->shouldBeCalled()->willReturn($lastNameString);
        $this->fullName->middleName()->shouldBeCalled()->willReturn($middleNameString);

        $this->firstNameMiddleNameLastName()->shouldReturn($firstNameString . ' ' . $middleNameString . ' ' . $lastNameString);

    }


    function it_formats_FirstName_Middle_Initial_and_LastName()
    {
        $seeder           = Factory::create();
        $firstNameString  = $seeder->firstName;
        $lastNameString   = $seeder->lastName;
        $middleNameString = $seeder->lastName;
        $this->fullName->firstName()->shouldBeCalled()->willReturn($firstNameString);
        $this->fullName->lastName()->shouldBeCalled()->willReturn($lastNameString);
        $this->fullName->middleName()->shouldBeCalled()->willReturn($middleNameString);

        $this->firstNameMiddleInitialLastName()->shouldReturn($firstNameString . ' ' . substr($middleNameString, 0, 1) . '. ' . $lastNameString);

    }

    function it_formats_LastName_FirstName_and_Middle_Initial()
    {
        $seeder           = Factory::create();
        $firstNameString  = $seeder->firstName;
        $lastNameString   = $seeder->lastName;
        $middleNameString = $seeder->lastName;
        $this->fullName->firstName()->shouldBeCalled()->willReturn($firstNameString);
        $this->fullName->lastName()->shouldBeCalled()->willReturn($lastNameString);
        $this->fullName->middleName()->shouldBeCalled()->willReturn($middleNameString);

        $this->lastnameFirstNameMiddleInitial()->shouldReturn($lastNameString . ', ' . $firstNameString . ' ' . substr($middleNameString, 0, 1) . '.');

    }

    function it_returns_the_default_Format_if_Middle_Name_is_not_provided() {
        $seeder           = Factory::create();
        $firstNameString  = $seeder->firstName;
        $lastNameString   = $seeder->lastName;
        $this->fullName->firstName()->shouldBeCalled()->willReturn($firstNameString);
        $this->fullName->lastName()->shouldBeCalled()->willReturn($lastNameString);
        $this->fullName->middleName()->shouldBeCalled()->willReturn(null);

        $this->firstNameMiddleNameLastName()
            ->shouldReturn($firstNameString . ' ' . $lastNameString);
        $this->firstNameMiddleInitialLastName()
            ->shouldReturn($firstNameString . ' ' . $lastNameString);
        $this->lastnameFirstNameMiddleInitial()
            ->shouldReturn($lastNameString . ', ' . $firstNameString);
    }
}
