<?php

define('ServiceUrl', 'https://raida.tech/inventory.php');


function pr($a = []) {
    echo "<pre>";
    print_r($a);
    echo "</pre>";
}

function fetchInventory() {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, ServiceUrl);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    //curl_setopt($ch, CURLOPT_HTTPGET, 1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
    curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 2);
    curl_setopt($ch, CURLOPT_POSTFIELDS,"password=5c4a9d7893e04");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if (!$resultFromAPI = curl_exec($ch)) {
        $resultFromAPI = curl_error($ch);
    }

    curl_close($ch);
    return $resultFromAPI;
}

$result = fetchInventory();

pr(json_decode($result, true));
die;
