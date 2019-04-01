<?php
$data = $_POST;
require_once("Rest_client/Rest_Client.php");

/*
**lấy giá khóa học từ api sang
*/

$config0 = array(
    'server' => 'http://api.lakita.vn/',
    'api_key' => 'RrF3rcmYdWQbviO5tuki3fdgfgr4',
    'api_name' => 'lakita-key',
);
$restClient0 = new Rest_Client($config0);
//$code_landing = 'http://'.$_SERVER['SERVER_NAME'];
$uri0 = "landingpage/price/".$_SERVER['SERVER_NAME'];
$result0 = $restClient0->get($uri0);
$rs = json_decode($result0);


$config = array(
    'server' => 'http://mol.lakita.vn/',
    'api_key' => 'SSeKfm7RXCJZxnFUleFsPf63o2ymZ93fWuCmvCjq',
    'api_name' => 'key',
    'http_user' => 'admin',
    'http_pass' => 'admin',
    'http_auth' => 'basic'
);
$restClient = new Rest_Client($config);
$uri = "contact_collection_api/add_contact";
$param = array(
    'course_code' => $rs->course_code,
    'price_purchase' => $rs->price,
    'name' => $data['name'],
    'phone' => $data['phone'],
    'email' => $data['email'],
    'tinh' => $data['tinh'],
    'quan' => $data['quan'],
    'dia_chi' => $data['dia_chi'],
    'country' => isset($data['country']) ? $data['country'] : '',
    'sector' => isset($data['sector']) ? $data['sector'] : '',
    'graduation' => isset($data['graduation']) ? $data['graduation'] : '',
    'id_camp_landingpage' => isset($data["id_camp_landingpage"]) ? $data["id_camp_landingpage"] : "-100",
    'domain' => isset($data["domain"]) ? $data["domain"] : "",
    'code_chanel' => isset($data["code_chanel"]) ? $data["code_chanel"] : "-100",
    'ip' => $_SERVER['REMOTE_ADDR'],
    'http_referer' => isset($data['http_referer']) ? $data['http_referer'] : '',
);
$result = $restClient->post($uri, $param);
echo json_encode($result);

