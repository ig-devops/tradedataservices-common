<?php

namespace TradeDataServices\Common\Classes;

use Countable;
use Iterator;

class Collection implements Iterator, Countable
{

    private $collection;
    private $position = 0;


    public function __construct()
    {
        $this->position = 0;
    }


    public function rewind()
    {
        $this->position = 0;
    }


    public function current()
    {
        return $this->collection[$this->position];
    }


    public function key()
    {
        return $this->position;
    }


    public function next()
    {
        ++$this->position;
    }


    public function valid()
    {
        return isset($this->collection[$this->position]);
    }


    public function count()
    {
        return count($this->collection);
    }


    public function add($item)
    {
        $this->collection[] = $item;
        return $this;
    }
}
