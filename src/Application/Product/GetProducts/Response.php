<?php

namespace App\Application\Product\GetProducts;

class Response
{

    private array $products;

    public function __construct(array $products) {
        $this->products = $products;
    }

    /**
     * Get the value of products
     */ 
    public function getProducts()
    {
        return $this->products;
    }
}
