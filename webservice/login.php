<?php 
require_once '../libs/Users.php';
require_once '../libs/Admin.php';
$user = new User();
$response = array(
	"status" => "error",
	"message" => "",
	"data" => array()
);

if(empty($_POST)){
	// if post data is not available redirects
	// to the home 
$response['message'] = "form data missing";
}

$device_id = filter_input(INPUT_POST, 'device_id');
$password = filter_input(INPUT_POST, 'password');
$loginData = $user->checkLogin($device_id,$password);
if(!empty($loginData)){
	$response['status'] = "success";
	$response['message'] = "Welcome ".$loginData[0]['name'];
	$response['data'] = array(
		"id" => $loginData[0]['id'],
		"name" => $loginData[0]['name'],
		"email" => $loginData[0]['email'],
	);

}



echo json_encode($response);

?>
