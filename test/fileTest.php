<?php

	 
    include "TopSdk.php";
    date_default_timezone_set('Asia/Shanghai'); 

    $c = new TopClient;
    $c->appkey = '12497914';
    $c->secretKey = '4b0f28396e072d67fae169684613bcd1';
     var_dump($c);

	$req = $c->load_api('ItemGetRequest');
     

?>