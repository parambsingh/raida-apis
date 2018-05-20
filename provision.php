<?php
// https://template.cloudcoin.global/service/link_template_to_sn.php?denomination=1&template=334&pk=99388377272
//https://template.cloudcoin.global/service/link_template_to_sn.php?sn=399882&template=334&pk=99388377272

define('ServiceUrl', 'https://raida.tech/upload_jpeg_with_json.php');
//define('ServiceUrl', 'http://localhost/upload/index.php');


function pr($a = []) { echo "<pre>"; print_r($a); echo "</pre>"; }

function connect() {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type:multipart/form-data"]);
    curl_setopt($ch, CURLOPT_URL, ServiceUrl);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPGET, 0);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE, false);
    curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 2);
    curl_setopt($ch, CURLOPT_POST, 1);
    
    $json = '{"id":"EX1_13","dbf_id":559,"series_name":"All about the funk","title":"Girl Pic","description":"At the Theater","price":10,"currency":"USD","genre":"Pop Music","type":"JPEG/PNG","category":"Entertainment","artist":"Gabe Allbo","number":"[REPLACE NUM]","of_total":"[REPLACE MAX]","issuer":true,"date_of_creation":"2018-03-24","date_of_issue":"[REPLACE ISSUE DATE]","date_modified":"0000-00-00","location":"Tampa Florida","rarity":"LEGENDARY","set":"EXPERT1","image_thumb_url":"here will be thumb URL if any","original_file_url":"here will be thumb URL if any"}';


    $fields = [
        'password' => '5c4a9d7893e04',
        'json' => $json,
        'replaceMax'=>10,
        'jpeg' => '@files/girl.jpg'
    ];

    //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

   
    if (!$resultFromAPI = curl_exec($ch)) {
        $resultFromAPI = curl_error($ch);
        pr($resultFromAPI);
    }

    curl_close($ch);
    return $resultFromAPI;
}

$result = connect();

pr($result);
die;
