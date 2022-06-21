<?php

declare(strict_types=1);

namespace App\Domain\Service;

class VendorService extends AbstractService
{
    public function __construct()
    {
        parent::__construct('vendors');
        $this->requiredFields = ['name', 'phone', 'email', 'taxId'];
    }

}