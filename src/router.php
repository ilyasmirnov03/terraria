<?php

$url = parse_url($_SERVER['REQUEST_URI']);
$route = trim(str_replace(APP_ROOT_URL, '', $url['path']));

$route = $route === '' ? '/' : $route;

switch ($route) {
    case '/':
        require 'pages/collection/collection.php';
        break;
    case '/d':
        require 'pages/json/json.php';
        break;
    default:
        require 'pages/404.php';
        break;
}   