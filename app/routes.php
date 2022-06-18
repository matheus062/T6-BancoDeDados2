<?php

declare(strict_types=1);

use App\Actions\Product\ProductDeleteAction;
use App\Actions\Product\ProductGetAction;
use App\Actions\Product\ProductSaveAction;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/products', function (RouteCollectorProxy $products) {
        $products->get('', ProductGetAction::class);
        $products->post('', ProductSaveAction::class);

        $products->group('/{product}', function (RouteCollectorProxy $product) {
            $product->get('', ProductGetAction::class);
            $product->put('', ProductSaveAction::class);
            $product->delete('', ProductDeleteAction::class);
        });
    });

    //TODO : Configurar rotas dos vendors

//    $app->group('/vendors', function (RouteCollectorProxy $vendors) {
//        $products->get('', ProductGetAction::class);
//        $products->post('', ProductSaveAction::class);
//
//        $products->group('/{product}', function (RouteCollectorProxy $product) {
//            $product->get('', ProductGetAction::class);
//            $product->put('', ProductSaveAction::class);
//            $product->delete('', ProductDeleteAction::class);
//        });
//    });
};