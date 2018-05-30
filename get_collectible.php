<?php

define('WP_USE_THEMES', false);
require('./wp-load.php');



function get_collectible($fileName, $dn = 1) {
    $returnArray = ['error' => false];
    $wp_upload_dir = wp_upload_dir();
    $celebPath = $wp_upload_dir['basedir'].'/celebriums/';
    $celebUrl = $wp_upload_dir['baseurl'].'/celebriums/';

    $options = [
        'dn'=> $dn,
        'pk' =>BANK_PASSWORD,
        'password'=>RAIDA_PASSWORD,
        'c_id'=>$fileName
    ];

    //~ $apiUrl = GET_COLLECTIBLE_API . http_build_query($options);
//~ 
    //~ try {
        //~ //cURL starts
        //~ $ch = curl_init();
        //~ curl_setopt($ch, CURLOPT_URL, $apiUrl);
        //~ curl_setopt($ch, CURLOPT_HTTPHEADER, 0);
        //~ curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //~ curl_setopt($ch, CURLOPT_HTTPGET,true);
        //~ $result = curl_exec($ch);
//~ 
        //~ //error handling for cURL
        //~ if ($result === false) {
            //~ $returnArray['error'] = true;
            //~ if(curl_error($ch)) {
                //~ $returnArray['message'] = curl_error($ch);
            //~ }
       //~ } else {
		   //~ 
            //~ $cc = json_decode($result, true);
            //~ if((isset($cc['status']) && in_array($cc['status'], ["fail", "error"] )) || empty($cc['cloudcoin'])){
					//~ $returnArray['error'] = true;
					//~ $returnArray['message'] = $cc['message'];
					//~ $headers = 'From: Celebrium™ <csupport@celebrium.com>' . "\r\n";
					//~ wp_mail('satwinder.singh.21@gmail.com', "Get Collectible - Error Message Memo - ". $fileName .", dn - " .$dn, json_encode($cc), $headers);
			//~ } else {
				//~ $c = $cc['cloudcoin']['0'];
				//~ 
				//~ $celebName = $dn.'.CloudCoin.' .$c['sn'].'.'.$c['nn'].'.'.explode('.', $fileName)[0];
				//~ $celebPath = $celebPath . $celebName . CELEB_EXTENSION;
//~ 
				//~ $f = fopen($celebPath,"w");
				//~ fwrite($f,json_encode($cc, JSON_PRETTY_PRINT));
				//~ fclose($f);
//~ 
				//~ $returnArray['url'] = get_site_url()."/download.php?file=" . $celebName;
				//~ $returnArray['path'] = $celebPath;
			//~ }
        //~ }
        //~ curl_close($ch);
//~ 
    //~ } catch (Exception $e) {
        //~ $returnArray['error'] = true;
        //~ $returnArray['message'] = $e->getMessage();
        //~ $headers = 'From: Celebrium™ <csupport@celebrium.com>' . "\r\n";
        //~ wp_mail('satwinder.singh.21@gmail.com', "Get Collectible - Error Message Memo - ". $fileName .", dn - " .$dn, $e->getMessage(), $headers);
    //~ }
    return $returnArray;
}


$order = [
	[
		'name'=>'brenda.jpg',
		 'qty'=> 10 
	],
	[
		'name'=>'greg.jpg',
		 'qty'=> 10 
	],
	[
		'name'=>'maggie.jpg',
		 'qty'=> 10 
	],
	[
		'name'=>'brock.jpg',
		 'qty'=> 10 
	],
	[
		'name'=>'nadine.jpg',
		 'qty'=> 10 
	]
];

$log = [];

//~ foreach($order as $key =>  $item){
	//~ $log[$key]['name'] = $item['name'];
	//~ for($i = 0; $i < $item['qty']; $i++){
			//~ $log[$key]['item'][$i] = get_collectible($item['name']);
	//~ }
//~ }

echo  json_encode($log); 
die;
