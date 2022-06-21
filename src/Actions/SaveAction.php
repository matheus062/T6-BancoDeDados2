<?php

declare(strict_types=1);

namespace App\Actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SaveAction
{
    private int $statusCode = 201;

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface      $response
    ): ResponseInterface
    {
        $serviceClass = $request->getAttribute('serviceClass');
        $service = new $serviceClass();
        $id = $request->getAttribute('id') ?? '';
        $data = json_decode($request->getBody()->getContents(), true);

        if (!empty($id)) {
            $result = $service->update($id, $data);
        } else {
            $result = $service->create($data);
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