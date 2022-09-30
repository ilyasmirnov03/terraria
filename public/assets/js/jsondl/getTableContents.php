<?php

$c = curl_init('https://terraria.wiki.gg/wiki/Item_IDs');
$html = curl_exec($c);

if (curl_error($c))
    die(curl_error($c));

curl_close($c);

echo $html;
