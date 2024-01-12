<?php

namespace TradeDataServices\Common\Classes;

use TradeDataServices\Common\Abstracts\StringValueObject;
use TradeDataServices\Common\Interfaces\ValueObject;

class FullName extends StringValueObject implements ValueObject
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


    protected function __construct(FirstName $firstName, LastName $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
    }


    public static function create(FirstName $firstName, LastName $lastName)
    {
        return new FullName($firstName, $lastName);
    }


    public function __toString()
    {
        return self::value();
    }


    public function value()
    {
        return trim($this->firstName->value() . ' ' . $this->lastName->value());
    }


    public function firstName()
    {
        return $this->firstName->value();
    }


    public function lastName()
    {
        return $this->lastName->value();
    }


    public function middleName()
    {
        if ($this->middleName instanceof MiddleName) {
            return $this->middleName->value();
        }

        return '';
    }


    public function addMiddleName(MiddleName $middleName)
    {
        $this->middleName = $middleName;
        return $this;
    }
}
