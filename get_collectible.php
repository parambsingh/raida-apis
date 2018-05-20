<?php
define('ServiceUrl', 'https://raida.tech/get_collectible.php');


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

    $fields = [
        'password' => '5c4a9d7893e04',
        'raida_password' => '5c4a9d7893e04',
        'collectible_file_name' => (empty($_GET['collectible_file_name'])) ? 'bigfoot.jpg' : $_GET['collectible_file_name'],
        'denomination' => (empty($_GET['denomination'])) ? 1 : $_GET['denomination']
    ];

    curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($fields));

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


$result = connect("sn=399882&template=334&pk=99388377272");

pr($result);
die;
