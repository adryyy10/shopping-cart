<?php

namespace App\Infrastructure\Controllers\Session;

use App\Application\Session\AddProduct;
use App\Application\Session\StartSession;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionController extends AbstractController
{

    /**
     * Add new product to session
     * 
     * @param Request $request
     * @param StartSession\QueryHandler $startSessionUseCase
     * @param AddProduct\CommandHandler $addProductUsecase
     * 
     * @return Response
     */
    public function addProduct(
        Request $request, 
        StartSession\QueryHandler $startSessionUseCase,
        AddProduct\CommandHandler $addProductUsecase
    ): Response {

        // Get productId from button clicked
        $productId = $request->get('productId');

        //session_destroy(); die();

        // Initialize session if it's not initialized yet
        $startSessionUseCase();

        // Prepare data as array to pass it to AddProduct\Command
        $data = [
            'productId' => (int)$request->get('productId'),
        ];

        var_dump($_SESSION['cart']); die();

        // Instantiate new AddProduct\Command that it will be passed as argument in $addProductUsecase
        $command = new AddProduct\Command((object)$data);
        $addProductUsecase($command);

        return $this->forward('App\Infrastructure\Controllers\Product\ProductController::listProducts', [
            'productId'     => $productId,
            'productsAdded' => $_SESSION['cart']
        ]);
    }

}
