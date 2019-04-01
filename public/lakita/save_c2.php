<?php
$data = $_POST;
    require_once("Rest_client/Rest_Client.php");
    $config = array(
        'server' => 'http://mol.lakita.vn/',
        'api_key' => 'SSeKfm7RXCJZxnFUleFsPf63o2ymZ93fWuCmvCjq',
        'api_name' => 'key',
        'http_user' => 'admin',
        'http_pass' => 'admin',
        'http_auth' => 'basic'
    );
    $restClient = new Rest_Client($config);
    $uri = "contact_collection_api/add";
    $param = array(

			'id_camp_landingpage' => isset($data["id_camp_landingpage"]) ? $data["id_camp_landingpage"] : "-100",
			'domain' => isset($data["domain"]) ? $data["domain"] : "",
			'code_chanel' => isset($data["code_chanel"]) ? $data["code_chanel"] : "-100",
			'ip' => $_SERVER['REMOTE_ADDR'],
                         'preview' =>isset($data["preview"]) ? $data["preview"] : "-100",
			'http_referer' => isset($data['http_referer']) ? $data['http_referer'] : '',
		);
    $result = $restClient->post($uri, $param);
	
//	
//    echo '<meta content="text/html; charset=utf-8" http-equiv="Content-Type">';
//    echo "<pre>";
   

