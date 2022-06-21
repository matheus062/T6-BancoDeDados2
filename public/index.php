<?php

declare(strict_types=1);

require_once __DIR__ . '/../app/config.php';
require_once __DIR__ . '/../vendor/autoload.php';

use MongoDB\Client;
use Slim\Factory\AppFactory;

$client = new Client(MONGO_DB_URI);
$db = $client->selectDatabase(MONGO_DB_NAME);
$requiredCollections = ['products', 'vendors'];
$collectionNames = [];

foreach ($db->listCollections() as $collection) {
    $collectionNames[] = $collection->getName();
}

foreach ($requiredCollections as $newCollection) {
    if (!in_array($newCollection, $collectionNames)) {
        $db->createCollection($newCollection);
    }
}

$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

(require __DIR__ . '/../app/routes.php')($app);

$app->run();