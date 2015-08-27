<?php

namespace Hautelook;

class Product
{
    protected $name;
    protected $price;
    protected $quantity;

    public function __construct($name, $quantity)
    {
        $this->name = $name;
        $this->quantity = $quantity;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setQuantity($num)
    {
        $this->quantity = $num;
    }
} 
