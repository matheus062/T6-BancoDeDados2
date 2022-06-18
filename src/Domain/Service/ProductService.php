<?php

declare(strict_types=1);

namespace App\Domain\Service;

use MongoDB\Client;
use MongoDB\Database;
use MongoDB\Model\IndexInfoIterator;


class ProductService
{
    private Database $db;

    public function __construct()
    {
        $client = new Client(MONGO_DB_URI);
        $this->db = $client->selectDatabase(MONGO_DB_NAME);
    }

    public function list(): IndexInfoIterator
    {
        $collection = $this->db->selectCollection('products');

        return $collection->listIndexes();
    }


}