<?php

declare(strict_types=1);

namespace App\Domain\Service;

class ProductService extends AbstractService
{
    public function __construct()
    {
        parent::__construct('products');
        $this->requiredFields = ['name', 'price', 'vendor', 'brand'];
    }

}