<?php

$is_localhost = ($_SERVER['REMOTE_ADDR'] == '127.0.0.1' or $_SERVER['REMOTE_ADDR'] == '::1');
if ($is_localhost) {
  require 'config-local.php';
  define('APP_MODE', 'dev');
} else {
  require 'config-production.php';
  define('APP_MODE', 'prod');
}

/** séparateur entre dossiers qui correspond à \ sur un windows ou / sur un linux */
define('DS', DIRECTORY_SEPARATOR);

// les types mime authorisés
define('APP_MIME_FOR_IMAGE', ["image/webp", "image/png", "image/jpg"]);

/** Chemin absolu vers le dossier du projet. (tp2)*/
define('APP_ROOT_DIRECTORY', realpath(__DIR__ . DS . '..' . DS . '..') . DS);

/** chemin absolu vers le dossier de l'application (tp2/src) */
define('APP_SRC_DIRECTORY', APP_ROOT_DIRECTORY . 'src' . DS);

/** chemin absolu vers le dossier des ressources CSS,JS,IMAGES (tp2/public/assets) */
define('APP_ASSETS_DIRECTORY', APP_ROOT_DIRECTORY . 'public' . DS . 'assets' . DS);

/** URL partielle de l'application - cette constante est utile pour le router */
define('APP_ROOT_URL', str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']));

/** URL complète de l'application en http:// ou https:// */
define(
  'APP_ROOT_URL_COMPLETE',
  isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] .
    "://{$_SERVER['HTTP_HOST']}" . APP_ROOT_URL : (strpos($_SERVER['SERVER_PROTOCOL'], 'HTTP/') !== false ? 'http' : 'https') .
    "://{$_SERVER['HTTP_HOST']}" . APP_ROOT_URL
);
