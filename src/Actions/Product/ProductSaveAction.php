<?php

declare(strict_types=1);

namespace App\Actions\Product;

use App\Domain\Service\ProductService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ProductSaveAction
{
    private int $statusCode = 201;
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
        $data = json_decode($request->getBody()->getContents(), true);

        if (!empty($id)) {
            $result = $this->service->update($id, $data);
        } else {
            $result = $this->service->create($data);
        }

        if (empty($result)) {
            $this->statusCode = 404;
            $result = ['message' => 'Não foi possível localizar nenhum registro.'];
        } elseif (is_array($result)) {
            $this->statusCode = 422;
        }

        $response->getBody()->write(json_encode($result));

        return $response->withStatus($this->statusCode);
    }


}