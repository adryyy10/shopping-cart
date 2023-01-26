<?php

namespace App\Application\Session\GetProductsFromSession;

use App\Domain\Product\Product;
use App\Domain\Product\ProductRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;

class QueryHandler
{

    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    // Magic method that is called when the object is called as a function
    public function __invoke(Query $query)
    {

        $products   = [];
        $finalPrice = 0;

        // Loop over products and get them from DB
        if (!empty($query->getProducts())) {

            foreach ($query->getProducts() as $product) {

                // Find a product by Id
                $product = $this->productRepository->findOneBy(["id" => $product['productId']]);

                // If we do not find the product, EntityNotFoundException
                if (empty($product)) {
                    throw new EntityNotFoundException("Product not found", Product::class);
                }

                // Push product into array
                array_push($products, $product);

                // Add product price to final price
                $finalPrice += $product->getPrice();
            }

        }

        // Return a Response with an array of product Objects and final price
        return new Response($products, $finalPrice);
    }

}
