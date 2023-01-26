<?php

namespace App\Domain\Product;

interface ProductRepositoryInterface
{

    public function findAll();

    public function findOneBy(array $criteria, array $orderBy = null);

}
