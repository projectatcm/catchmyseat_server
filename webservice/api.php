<?php

require 'libs/Drivers.php';
require 'libs/Passenger.php';
$driver = new Drivers();
$passenger = new Passenger();
$request = $_SERVER['REQUEST_METHOD'];


$response = array(
"status" => "error"
);


if($request == "POST"){
	$action = filter_input(INPUT_POST, 'action');

	if($action == "driver_register"){
        $name = filter_input(INPUT_POST,"name");
        $vehicle = filter_input(INPUT_POST,"vehicle");
        $mobile = filter_input(INPUT_POST,"mobile");
        $email = filter_input(INPUT_POST,"email");
        $password = filter_input(INPUT_POST,"password");
        $gcm_id = filter_input(INPUT_POST,"gcm_id");
        $status = filter_input(INPUT_POST,"status");
        $result = $driver->setDriverData($name,$vehicle,$mobile,$email,$password,$gcm_id,$status);
        if($result){
            $response['status'] = "success";
            $response['user_id'] = $result;
        }
	}
	if($action == "passenger_register"){
        $name = filter_input(INPUT_POST,"name");
        $mobile = filter_input(INPUT_POST,"mobile");
        $email = filter_input(INPUT_POST,"email");
        $password = filter_input(INPUT_POST,"password");
         $gcm_id = filter_input(INPUT_POST,"gcm_id");
        $status = filter_input(INPUT_POST,"status");
        $result = $passenger->setPassengerData($name,$mobile,$email,$password,$gcm_id,$status);
        if($result){
            $response['status'] = "success";
            $response['user_id'] = $result;
        }
	}
	if($action == "update_location"){
        $driver_id = filter_input(INPUT_POST,"driver_id");
        $latitude = filter_input(INPUT_POST,"latitude");
        $longitude = filter_input(INPUT_POST,"longitude");
        $result = $driver->updateLocation($driver_id,$latitude,$longitude);
        // if($result){
        //     $response['status'] = "updated";
        // }
	}

    if ($action == "login") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $driverData = $driver->driverLogin($email, $password);
        $passengeData = $passenger->passengerLogin($email, $password);
       
        if (!empty($driverData)) {  
            $response['status'] = 'success';
            $response['user_id'] = $driverData[0]['id'];
            $response['user_name'] = $driverData[0]['name'];
            $response['user_type'] = 'driver';
        } 
        else if (!empty($passengeData)) {
            $response['status'] = 'success';
            $response['user_id'] = $passengeData[0]['id'];
            $response['user_name'] = $passengeData[0]['name'];
            $response['user_type'] = 'passenger';
        }
         else {
           
        }

    }

      if ($action == "find_driver") {
        $latitude = $_POST['latitude'];
        $longitde = $_POST['longitude'];
        $geo_data = $driver->getData("SELECT * FROM geo");
        $data = array();
//        echo "($latitude,$longitde)";
        foreach ($geo_data as $geo) {
            $driver_id = $geo['driver_id'];
            $driver_lat = $geo['latitude'];
            $driver_lng = $geo['longitude'];
            $driver_data = $driver->getDriverDataById($driver_id);
            if(empty($driver_data)){
                continue;
            }
            //$driver_data[0]['photo'] = base64Image($driver_data[0]['photo']);
            $distance = distance($latitude, $longitde, $driver_lat, $driver_lng, 'K');
            $distance = round($distance, 1);
            if($distance > 1){
                continue;
            }
           $geo['distance'] = $distance;
                $geo['data'] = $driver_data[0];
            $data[] = $geo;
        }
//        print_r($data);
//        exit();
 $response['status'] = 'success';
  $response['data'] = $data;

    }

}

if($request == "GET"){
	$action = filter_input(INPUT_GET, 'action');

	if($action == "get_drivers"){
		
	}
}



    echo json_encode($response);



    function distance($lat1, $lon1, $lat2, $lon2, $unit) {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}

?>