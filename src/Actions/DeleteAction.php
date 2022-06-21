<?php

declare(strict_types=1);

namespace App\Actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DeleteAction
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

        if (empty($id)) {
            $this->statusCode = 400;
            $response->getBody()->write(json_encode(['id' => 'ID do registro não enviado.']));
            return $response->withStatus($this->statusCode);
        }

        $result = $service->delete($id);

        if (is_array($result)) {
            $this->statusCode = 404;
        } else {
            $result = ['message' => 'Registro deletado com sucesso.'];
        }

        $response->getBody()->write(json_encode($result));

        return $response->withStatus($this->statusCode);
    }

}