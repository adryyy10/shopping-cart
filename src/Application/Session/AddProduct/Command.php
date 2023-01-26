<?php

namespace App\Application\Session\AddProduct;

use App\Application\Shared\AbstractCommand;
use stdClass;
use Webmozart\Assert\Assert;

class Command extends AbstractCommand
{

    protected $data;

    public function __construct(stdClass $data) {

        // Call the parent in order to check assertMandatoryAttributes 
        parent::__construct($data);
        $this->data = $data;
    }

    /**
     * Get the value of productId
     */ 
    public function getProductId()
    {
        return $this->data->productId;
    }

    /**
     * This method checks the type of the variables and if they are mandatory or not
     */
    protected function assertMandatoryAttributes()
    {
        // Assert if productId exists and is an array
        Assert::propertyExists($this->data, 'productId');
        Assert::integer($this->data->productId);
    }

}
