<?php
$paths = array(
    'urls/account.php',
    'urls/profile.php',
    'urls/wallet.php',
    'urls/bet.php'
);

$api = array();

foreach ($paths as $path){
    $myApi = include $path;
    $api = array_merge($api, $myApi);
}

return $api;
