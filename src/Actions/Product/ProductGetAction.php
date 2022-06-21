<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Domain\Service\ProductService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductGetAction
{
    private int $statusCode = 200;
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

        if (!empty($id)) {
            $result = $this->service->read($id);
        } else {
            $result = $this->service->list();
        }

        if (empty($result)) {
            $this->statusCode = 404;
            $result = ['message' => 'Nenhum resultado encontrado.'];
        }

        $response->getBody()->write(json_encode($result));

        return $response->withStatus($this->statusCode);
    }
}