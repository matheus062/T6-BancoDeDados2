<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Domain\Service\ProductService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductDeleteAction
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
        $id = $request->getAttributes()['id'] ?? '';

        if (empty($id)) {
            $this->statusCode = 400;
            $response->getBody()->write(json_encode(['id' => 'ID do registro não enviado.']));
            return $response->withStatus($this->statusCode);
        }

        $result = $this->service->delete($id);

        if (is_array($result)) {
            $this->statusCode = 404;
        } else {
            $result = ['message' => 'Registro deletado com sucesso.'];
        }

        $response->getBody()->write(json_encode($result));

        return $response->withStatus($this->statusCode);
    }

}