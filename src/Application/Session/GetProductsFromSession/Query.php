<?php

namespace App\Application\Session\GetProductsFromSession;

use App\Application\Shared\AbstractCommand;
use stdClass;
use Webmozart\Assert\Assert;

class Query extends AbstractCommand
{

    protected $data;

    public function __construct(stdClass $data) {

        // Call the parent in order to check assertMandatoryAttributes 
        parent::__construct($data);
        $this->data = $data;
    }

    /**
     * Get the value of products
     */ 
    public function getProducts()
    {
        return $this->data->products;
    }

    /**
     * This method checks the type of the variables and if they are mandatory or not
     */
    protected function assertMandatoryAttributes()
    {
        // Assert if products exists and is an array
        Assert::propertyExists($this->data, 'products');
        Assert::isArray($this->data->products);
    }
}
