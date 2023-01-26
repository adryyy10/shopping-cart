<?php

namespace App\Tests\Application\Product;

use App\Application\Product\GetProducts;
use App\Domain\Product\ProductRepositoryInterface;
use PHPUnit\Framework\TestCase;

class GetProductsQueryHandlerTest extends TestCase
{

    protected array $mocks = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->initMocks();
    }

    private function initMocks()
    {
        $this->mocks[ProductRepositoryInterface::class] = $this->createMock(ProductRepositoryInterface::class); 
    }

    private function initHandler(): GetProducts\QueryHandler
    {
        return new GetProducts\QueryHandler(
            $this->mocks[ProductRepositoryInterface::class]
        );
    }

    private function findAllProducts()
    {
        $this->mocks[ProductRepositoryInterface::class]
        ->expects($this->once())
        ->method('findAll')
        ->willReturn([]);
    }

    public function testGetProducts()
    {
        $this->findAllProducts();

        $handler = $this->initHandler();
        $response = $handler();

        $this->assertIsArray($response->getProducts());
        $this->assertInstanceOf(GetProducts\Response::class, $response);
    }
}
