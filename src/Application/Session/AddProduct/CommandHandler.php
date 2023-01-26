<?php

namespace App\Application\Session\AddProduct;

use Exception;

class CommandHandler
{

    /**
     * 
     * Add new incoming product
     * 
     * @param Command $command
     */
    public function __invoke(Command $command)
    {
        $productId          = $command->getProductId();
        $numberOfProducts   = 0;

        if (isset($_SESSION['cart'])) {

            // Returning values from single productId column
            $productArrayId = array_column($_SESSION['cart'], "productId");
            
            // Check if product is already picked
            try {
                $this->checkExistingProduct($productId, $productArrayId);
            } catch (Exception $e) {
                echo $e->getMessage();
                return;
            }

            // Get total of products added
            $numberOfProducts = count($_SESSION['cart']);
        }
        
        $this->addNewProduct($productId, $numberOfProducts);
    }

    /**
     * Adding new product to cart session
     * 
     * @param int $productId
     * @param int $numberOfProducts
     * 
     * @return void
     */
    private function addNewProduct (int $productId, int $numberOfProducts): void   
    {
        $newProduct = [
            'productId' => $productId
        ];

        // Add new product to cart session
        $_SESSION['cart'][$numberOfProducts] = $newProduct;
    }

    /**
     * Check if product is already picked
     * 
     * @param int $productId
     * @param array $productArrayId
     * 
     * @return void
     */
    private function checkExistingProduct (int $productId, array $productArrayId): void
    {
        // If product already exists, we do not add it to the session
        if (in_array($productId, $productArrayId)) {
            throw new Exception("Product already added");
        } 
    }

}
