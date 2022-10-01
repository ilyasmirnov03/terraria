<?php

/**
 * Affiche le head du HTML.
 *
 * @param string $title  le titre de la page.
 * @return void
 */
function head(string $title = '', string $link = ''): string
{
  return  <<<HTML_HEAD
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="$link" rel="stylesheet">
  <title>$title</title>
</head>
HTML_HEAD;
}

function doc_end(): string
{
  return  <<<HTML_FOOTER
</body>
</html>
HTML_FOOTER;
}

function url(string $url = ''): string
{
  $url = substr($url, 0, 1) != '/' ? '/' . $url : $url;
  return APP_ROOT_URL_COMPLETE . $url;
}

function redirect(string $url = '/')
{
  header('Location: ' . APP_ROOT_URL_COMPLETE . $url);
}
