<?php

namespace App\Infrastructure\Controllers\Cart;

use App\Application\Session\GetProductsFromSession;
use App\Application\Session\StartSession;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    /**
     * @Route("/cart", name="app_cart")
     * 
     * @param Request $request
     * 
     * 
     * @return Response
     */
    public function listProducts(
        Request $request,
        GetProductsFromSession\QueryHandler $getProductsFromSessionUseCase,
        StartSession\QueryHandler $startSessionUseCase
    ): Response {

        // Initialize session if it's not initialized yet
        $startSessionUseCase();

        // Instantiate new GetProductsFromSession\Query that it will be passed as argument in $getProductsFromSessionUseCase
        $query = new GetProductsFromSession\Query((object)["products" => (isset($_SESSION['cart'])) ? $_SESSION['cart'] : []]);
        $response = $getProductsFromSessionUseCase($query);

        return $this->render('cart/listing.html.twig', [
            'products'      => $response->getProducts(),
            'finalPrice'    => $response->getFinalPrice(),
            'discount'      => $request->get('discount')
        ]);
    }

}
