<?php

//
// Fichier: src\Model\Model.php
//

namespace App\Model;

class Model
{
    protected $collectionName;
    protected static $client;

    public function __construct()
    {
        if (!self::$client) {
            self::$client = new \MongoDB\Client(MONGO_DB_CONN);
        }
    }

    public function findAll()
    {
        return self::$client->items->item->find([], ['sort'=>['id'=> 1]]);
    }
}
