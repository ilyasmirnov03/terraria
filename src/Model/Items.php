<?php

namespace App\Model;

class Items extends Model
{
    protected $collectionName = 'item';
    protected static $instance;

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}