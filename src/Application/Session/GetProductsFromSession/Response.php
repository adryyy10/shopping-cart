<?php

namespace App\Application\Session\GetProductsFromSession;

class Response
{

    private array $products;
    private float $finalPrice;

    public function __construct(array $products, float $finalPrice) {
        $this->products = $products;
        $this->finalPrice = $finalPrice;
    }

    /**
     * Get the value of products
     */ 
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Get the value of finalPrice
     */ 
    public function getFinalPrice()
    {
        return $this->finalPrice;
    }
}
