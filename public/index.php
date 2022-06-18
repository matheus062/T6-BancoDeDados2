<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

(require __DIR__ . '/../app/routes.php')($app);

$app->run();

//$client = new Client('mongodb://localhost:27017');
//
//$db = $client->selectDatabase(DB_URI);
//
//$service = new ProductService($db);
//
//$list = $service->list();
//
//die($list);
//
//
//$products = $db->selectCollection('products');
//
//$result = $products->insertMany([
//    [
//        'name' => 'Luigi Bros',
//        'price' => 250.00,
//        'brand' => 'Nintendo',
//        'vendor' => 'Nintendo S.A.'
//    ],
//    [
//        'name' => 'Mario bros',
//        'price' => 1000.00,
//        'brand' => 'Nintendo',
//        'vendor' => 'Nintendo S.A.'
//    ],
//    [
//        'name' => 'Bowser',
//        'price' => 250.00,
//        'brand' => 'Nintendo',
//        'vendor' => 'Nintendo S.A.',
//        'armor' => 1500,
//        'childs' => [
//            'Larry Koopa',
//            'Morton Koopa Jr.',
//            'Roy Koopa'
//        ]
//    ],
//]);
//
//die(json_encode($result->getInsertedIds()));