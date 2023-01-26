<?php

namespace App\Infrastructure\Controllers\Product;

use App\Application\Product\GetProducts;
use App\Application\Session\StartSession;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    /**
     * @Route("/products", name="app_listing_products")
     * 
     * @param Request $request
     * 
     * Autowiring
     * @param StartSession\QueryHandler $startSessionUseCase
     * @param GetProducts\QueryHandler $productsUseCase
     * 
     * @return Response
     */
    public function listProducts(
        StartSession\QueryHandler $startSessionUseCase,
        GetProducts\QueryHandler $productsUseCase
    ): Response {

        // Get cart session if exists
        $startSessionUseCase();

        // Get the Response of $productsUseCase thanks to calling itself as a function and that triggers __invoke() method
        $productsResponse = $productsUseCase();

        // Return twig template with necessary data
        return $this->render('products/listing.html.twig', [
            "products"      => $productsResponse->getProducts(),
            "productsAdded" => !empty($_SESSION['cart']) ? $_SESSION['cart'] : null
        ]);
    }

}
