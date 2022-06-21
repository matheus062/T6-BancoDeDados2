<?php

declare(strict_types=1);

namespace App\Actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetAction
{
    private int $statusCode = 200;

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface      $response
    ): ResponseInterface
    {
        $serviceClass = $request->getAttribute('serviceClass');
        $service = new $serviceClass();
        $id = $request->getAttribute('id') ?? '';

        if (!empty($id)) {
            $result = $service->read($id);
        } else {
            $result = $service->list();
        }

        if (empty($result)) {
            $this->statusCode = 404;
            $result = ['message' => 'Nenhum registro encontrado.'];
        }

        $response->getBody()->write(json_encode($result));

        return $response->withStatus($this->statusCode);
    }
}