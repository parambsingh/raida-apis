<?php
// https://template.cloudcoin.global/service/link_template_to_sn.php?denomination=1&template=334&pk=99388377272
//https://template.cloudcoin.global/service/link_template_to_sn.php?sn=399882&template=334&pk=99388377272

define('ServiceUrl', 'https://raida.tech/upload_jpeg_with_json.php');
//define('ServiceUrl', 'http://localhost/upload/index.php');

function pr($a = []) { echo "<pre>"; print_r($a); echo "</pre>"; }


//curl -i -X POST -H "Content-Type: multipart/form-data" -F "jpeg[]=@/var/www/html/tests/raida-apis/files/girl-3.jpg;filename=girl-3.jpg;type=image/jpeg;" -F 'password=5c4a9d7893e04' https://raida.tech/upload_jpeg_with_json.php

//echo __DIR__; die;

// data fields for POST request
$json = '{"id":"EX1_13","dbf_id":559,"series_name":"All about the funk","title":"Girl Pic","description":"At the Theater","price":10,"currency":"USD","genre":"Pop Music","type":"JPEG/PNG","category":"Entertainment","artist":"Gabe Allbo","number":"[REPLACE NUM]","of_total":"[REPLACE MAX]","issuer":true,"date_of_creation":"2018-03-24","date_of_issue":"[REPLACE ISSUE DATE]","date_modified":"0000-00-00","location":"Tampa Florida","rarity":"LEGENDARY","set":"EXPERT1","image_thumb_url":"here will be thumb URL if any","original_file_url":"here will be thumb URL if any"}';
$fields = ['password' => '5c4a9d7893e04', 'json' => $json, 'replaceMax'=>10];

// files to upload
$filenames = ['jpeg'=>realpath('files/girl-3.jpg')];

$files = [];
foreach ($filenames as $f){
   $files[$f] = file_get_contents($f);
}

// URL to upload to
$url = "https://raida.tech/upload_jpeg_with_json.php";


// curl

$curl = curl_init();


$boundary = uniqid();
$delimiter = '-------------' . $boundary;

$post_data = build_data_files($boundary, $fields, $files);


curl_setopt_array($curl, [
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => 1,
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  //CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POST => 1,
  CURLOPT_POSTFIELDS => $post_data,
  CURLOPT_HTTPHEADER => [ "Content-Type: multipart/form-data; boundary=" . $delimiter, "Content-Length: " . strlen($post_data) ],
  
]);


//
$response = curl_exec($curl);

$info = curl_getinfo($curl);
//echo "code: ${info['http_code']}";

//print_r($info['request_header']);

var_dump($response);
$err = curl_error($curl);

echo "error";
var_dump($err);
curl_close($curl);

function build_data_files($boundary, $fields, $files){
    $data = '';
    $eol = "\r\n";

    $delimiter = '-------------' . $boundary;

    foreach ($fields as $name => $content) {
        $data .= "--" . $delimiter . $eol
            . 'Content-Disposition: form-data; name="' . $name . "\"".$eol.$eol
            . $content . $eol;
    }


    foreach ($files as $name => $content) {
        $data .= "--" . $delimiter . $eol
            . 'Content-Disposition: form-data; name="jpeg"; filename="' . $name . '"' . $eol
            . 'Content-Type: image/jpeg'.$eol
            . 'Content-Transfer-Encoding: binary'.$eol
            ;

        $data .= $eol;
        $data .= $content . $eol;
    }
    $data .= "--" . $delimiter . "--".$eol;

    return $data;
}


die;
