<?php 

require '../libs/Drivers.php';
require '../libs/Passenger.php';
$driver = new Drivers();
$passenger = new Passenger();
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

$mobile = filter_input(INPUT_POST, 'mobile');
$password = filter_input(INPUT_POST, 'password');
$passengerLogin = $passenger->passengerLogin($mobile,$password);
$driverLogin = $driver->driverLogin($mobile,$password);
if(!empty($passengerLogin)){
		$response['status'] = "success";
			$response['message'] = "Welcome ".$passengerLogin[0]['name'];
			$response['data'] = array(
		"id" => $passengerLogin[0]['id'],
		"name" => $passengerLogin[0]['name'],
		"type" => "passenger"
	);
}else if(!empty($driverLogin)){
	$response['status'] = "success";
	$response['message'] = "Welcome ".$driverLogin[0]['name'];
	$response['data'] = array(
		"id" => $driverLogin[0]['id'],
		"name" => $driverLogin[0]['name'],
		"type" => "driver",
                 "status" =>  $driverLogin[0]['status']
	);

}



echo json_encode($response);

?>
