<?php

declare(strict_types=1);

use App\Actions\DeleteAction;
use App\Actions\GetAction;
use App\Actions\SaveAction;
use App\Domain\Service\ProductService;
use App\Domain\Service\VendorService;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {
    $app->group('/products', function (RouteCollectorProxy $products) {
        $products->get('', GetAction::class)->setArgument('serviceClass', ProductService::class);
        $products->post('', SaveAction::class)->setArgument('serviceClass', ProductService::class);

        $products->group('/{id}', function (RouteCollectorProxy $product) {
            $product->get('', GetAction::class)->setArgument('serviceClass', ProductService::class);
            $product->put('', SaveAction::class)->setArgument('serviceClass', ProductService::class);
            $product->delete('', DeleteAction::class)->setArgument('serviceClass', ProductService::class);
        });
    });

    $app->group('/vendors', function (RouteCollectorProxy $vendors) {
        $vendors->get('', GetAction::class)->setArgument('serviceClass', VendorService::class);
        $vendors->post('', SaveAction::class)->setArgument('serviceClass', VendorService::class);

        $vendors->group('/{id}', function (RouteCollectorProxy $vendor) {
            $vendor->get('', GetAction::class)->setArgument('serviceClass', VendorService::class);
            $vendor->put('', SaveAction::class)->setArgument('serviceClass', VendorService::class);
            $vendor->delete('', DeleteAction::class)->setArgument('serviceClass', VendorService::class);
        });
    });
};