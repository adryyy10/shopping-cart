<?php

namespace App\Tests\Application\Session;

use App\Application\Session\GetProductsFromSession;
use App\Domain\Product\Product;
use App\Domain\Product\ProductRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;
use PHPUnit\Framework\TestCase;
use stdClass;

class GetProductsFromSessionQueryHandlerTest extends TestCase
{

    protected stdClass $data;
    protected array $mocks = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->data = (object) [
            'products' => [
                ['productId' => 1]
            ]
        ];

        $this->initMocks();
    }

    private function initMocks()
    {
        $this->mocks[ProductRepositoryInterface::class] = $this->createMock(ProductRepositoryInterface::class); 
        $this->mocks[Product::class]                    = $this->createMock(Product::class); 
    }

    private function initHandler(): GetProductsFromSession\QueryHandler
    {
        return new GetProductsFromSession\QueryHandler(
            $this->mocks[ProductRepositoryInterface::class]
        );
    }

    private function findProduct(bool $willThrowException = false)
    {
        if ($willThrowException) {
            $this->mocks[ProductRepositoryInterface::class]
            ->expects($this->once())
            ->method('findOneBy')
            ->willThrowException(new EntityNotFoundException('Product not found'));
        } else {
            $this->mocks[ProductRepositoryInterface::class]
            ->expects($this->once())
            ->method('findOneBy')
            ->willReturn($this->mocks[Product::class]);
        }
    }

    // Happy path
    public function testGetProducts()
    {
        $query = new GetProductsFromSession\Query((object) $this->data);

        $handler = $this->initHandler();

        $this->findProduct();

        $response = $handler($query);

        $this->assertIsArray($response->getProducts());
        $this->assertIsFloat($response->getFinalPrice());
        $this->assertInstanceOf(GetProductsFromSession\Response::class, $response);
    }

    // Test that throw EntityNotFoundException because it didn't find the product
    public function testProductNotFound()
    {
        $query = new GetProductsFromSession\Query((object) $this->data);
        $handler = $this->initHandler();

        $this->findProduct(true);

        $this->expectException(EntityNotFoundException::class);
        $handler($query);
    }

}
