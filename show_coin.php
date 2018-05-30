<?php

define('GET_COLLECTIBLE_API','https://bank.celebrium.com/show_coins.aspx?');
define('BANK_PASSWORD', '2DD4F9C5-22FC-4B5C-A6C7-860EB657F399');

function pr($a = []){ echo "<pre>"; print_r($a); echo "</pre>"; }

function show_coin() {

    $options = ['pk' =>BANK_PASSWORD];

    $apiUrl = GET_COLLECTIBLE_API . http_build_query($options);

    try {
        //cURL starts
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPGET,true);
        $result = curl_exec($ch);
        
        //error handling for cURL
        if ($result === false) {
            $returnArray['error'] = true;
            if(curl_error($ch)) {
                $returnArray['message'] = curl_error($ch);
            }
       } else {
            $cc = json_decode($result, true);
            if((isset($cc['status']) && in_array($cc['status'], ["fail", "error"] ))){
					$returnArray['error'] = true;
					$returnArray['message'] = $cc['message'];
			} else {
				pr($cc);
				$returnArray['result'] = $cc;
			}
        }
        curl_close($ch);

    } catch (Exception $e) {
        $returnArray['error'] = true;
    }
     return $returnArray;
}

show_coin();
die;
