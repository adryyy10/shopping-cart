<?php

namespace App\Application\Product\GetProducts;

use App\Domain\Product\ProductRepositoryInterface;

class QueryHandler
{

    private ProductRepositoryInterface $productRepository;

    /**
     * Instead of directly injecting the repository, we use DIP to pass the interface through dependencies
     */
    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    public function __invoke(): Response
    {
        $products = $this->productRepository->findAll();

        return new Response($products);
    }

}
