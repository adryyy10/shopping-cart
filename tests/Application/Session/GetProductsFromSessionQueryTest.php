<?php

namespace App\Tests\Application\Session;

use App\Application\Session\GetProductsFromSession;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;

class GetProductsFromSessionQueryTest extends TestCase
{

    private stdClass $data;

    protected function setUp(): void
    {
        parent::setUp();

        $this->data = (object) [
            'products' => []
        ];
    }

    // Happy path
    public function testValidQuery()
    {
        $query = new GetProductsFromSession\Query((object) $this->data);

        $this->assertIsArray($query->getProducts());
    }

    // Test that throw InvalidArgumentException because $this->data->products doesn't exist
    public function testGetProductsNotExistsException()
    {
        $this->data = (object) [];

        $this->expectException(InvalidArgumentException::class);

        new GetProductsFromSession\Query($this->data);
    }

    // Test that throw InvalidArgumentException because $this->data->products is a string instead of an array
    public function testGetProductsNotArrayException()
    {
        $this->data->products = '';

        $this->expectException(InvalidArgumentException::class);

        new GetProductsFromSession\Query($this->data);
    }

}
