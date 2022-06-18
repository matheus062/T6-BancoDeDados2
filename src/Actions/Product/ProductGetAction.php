<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Domain\Service\ProductService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductGetAction
{
    private ProductService $service;

    public function __construct()
    {
        $this->service = new ProductService();
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface      $response
    ): ResponseInterface
    {
        $id = $request->getQueryParams()['id'] ?? '';

        $list = $this->service->list();

        if (!empty($id)) {
            //Read no registro específico
        }

        //Listar todos os registros
        return $response;
    }
}