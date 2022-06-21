<?php

namespace App\Domain\Service;

use MongoDB\BSON\ObjectId;
use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Database;
use MongoDB\Driver\Exception\InvalidArgumentException;

abstract class AbstractService
{
    protected Database $db;
    protected Collection $collection;
    protected array $requiredFields = [];

    public function __construct($collection)
    {
        $client = new Client(MONGO_DB_URI);
        $this->db = $client->selectDatabase(MONGO_DB_NAME);
        $this->collection = $this->db->selectCollection($collection);
    }

    public function list(): array|null
    {
        return $this->collection->find()->toArray();
    }

    public function read(string $id): array|null
    {
        try {
            $obId = new ObjectId($id);
        } catch (InvalidArgumentException) {

            return ['id' => 'ID do registro enviado é inválido.'];
        }

        return $this->collection->find(['_id' => $obId])->toArray();
    }

    public function create(array $data): string|array
    {
        foreach ($this->requiredFields as $field) {
            if (!key_exists($field, $data)) {
                $messages[$field] = 'Campo obrigatório';
            }
        }

        return $messages ?? ((string)$this->collection->insertOne($data)->getInsertedId());
    }

    public function update(string $id, mixed $data): string|array
    {
        try {
            $obId = new ObjectId($id);
        } catch (InvalidArgumentException) {

            return ['id' => 'ID do registro enviado é inválido.'];
        }

        $updated = [];
        $register = $this->collection->find(['_id' => $obId])->toArray();

        if (empty($register)) {
            return ['id' => 'Não foi possível localizar o registro.'];
        }
        foreach ($register[0] as $field => $value) {
            if ($field === '_id') {
                continue;
            }

            $updated[$field] = $data[$field] ?? $value;
        }

        $this->collection->updateOne(['_id' => $obId], ['$set' => $updated]);

        return $id;
    }

    public function delete(string $id): bool|array
    {
        try {
            $obId = new ObjectId($id);
        } catch (InvalidArgumentException) {

            return ['id' => 'ID do registro enviado é inválido.'];
        }

        $register = $this->collection->find(['_id' => $obId])->toArray();

        if (empty($register)) {
            return ['id' => 'Não foi possível localizar o registro.'];
        }

        $this->collection->deleteOne(['_id' => $obId]);

        return true;
    }
}