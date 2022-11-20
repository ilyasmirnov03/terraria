<?php

# Base file for all components #

// autoloading

use App\Model\Items;

require '../vendor/autoload.php';

// config for db
require 'config/config.php';

// useful functions
require 'functions.php';

$cursor = Items::getInstance()->findAll();

require 'router.php';