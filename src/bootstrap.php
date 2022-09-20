<?php

# Base file for all components #

// config for db
require 'config/config.php';

// useful functions
require 'functions.php';

// db connection
try {
    $dsn = 'mysql:host=' . APP_DB_HOST . ';dbname=' . APP_DB_NAME . ';charset=UTF8';
    $dbh = new PDO(
        $dsn,
        APP_DB_USER,
        APP_DB_PASSWORD,
        [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]
    );
} catch (PDOException $e) {
    echo '<div style="font-size: 22px;color: red;padding: 2rem">';
    echo "<h1>Error</h1><p>{$e->getMessage()}</p>";
    echo '</div>';
    die();
}

require 'router.php';