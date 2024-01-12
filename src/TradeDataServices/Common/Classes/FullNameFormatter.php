<?php

namespace TradeDataServices\Common\Classes;

class FullNameFormatter
{

    /**
     *
     * @var FullName
     */
    private $fullName;

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


    public function __construct(FullName $fullName)
    {
        $this->fullName   = $fullName;
        $this->firstName  = $this->fullName->firstName();
        $this->lastName   = $this->fullName->lastName();
        $this->middleName = $this->fullName->middleName();
    }


    private function hasNoMiddleName()
    {
        return trim($this->middleName) === '';
    }


    public function firstNameMiddleNameLastName()
    {
        if ($this->hasNoMiddleName()) {
            return trim($this->firstName . ' ' . $this->lastName);
        }

        return $this->formatByFirstNameMiddleNameLastName();
    }


    private function formatByFirstNameMiddleNameLastName()
    {
        return trim(
            $this->firstName . ' ' .
            $this->middleName . ' ' .
            $this->lastName
        );
    }


    public function firstNameMiddleInitialLastName()
    {
        if ($this->hasNoMiddleName()) {
            return trim($this->firstName . ' ' . $this->lastName);
        }

        return $this->formatByFirstNameMiddleInitialLastName();
    }


    private function formatByFirstNameMiddleInitialLastName()
    {
        return trim(
            $this->firstName . ' ' .
            substr($this->middleName, 0, 1) . '. ' .
            $this->lastName
        );
    }


    public function lastNameFirstName()
    {
        return trim($this->lastName . ' ' . $this->firstName);
    }


    public function lastnameFirstNameMiddleInitial()
    {
        if ($this->hasNoMiddleName()) {
            return trim($this->lastName . ', ' . $this->firstName);
        }

        return $this->formatByLastnameFirstNameMiddleInitial();
    }


    private function formatByLastnameFirstNameMiddleInitial()
    {
        return trim(
            $this->lastName . ', ' .
            $this->firstName . ' ' .
            substr($this->middleName, 0, 1) . '. '
        );
    }
}
