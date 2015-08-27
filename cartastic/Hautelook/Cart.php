<?php
namespace Hautelook;

class Cart
{
    private $items = array();

    public function __construct() {
    }


    public function subtotal() {
        return 0;
    }

    public function getCartItemsCount() {
        return count($this->items);

    }

    public function getTotalQuantityInCart() {
        $total = 0;

        foreach($this->items as $item){
            $total = $total + $item;
        }

        return $total;
    }

    public function addItem($product, $quantity) {
        $available = $product->getQuantity();
        if ($quantity > $available) {
            $quantity = $available;
        }

        $product->setQuantity($available - $quantity);

        if(isset($this->items[$product->getName()]))
        {
            $this->items[$product->getName()] = $this->items[$product->getName()] + $quantity;
        } else {
            $this->items[$product->getName()] = $quantity;
        }
    }

    public function updateItem($product, $quantity)
    {
        $available = $product->getQuantity();
        $current = $this->items[$product->getName()];

        $this->items[$product->getName()] = $quantity;

        $count = $quantity - $current;

        $product->setQuantity($available - $count);
    }
} 
