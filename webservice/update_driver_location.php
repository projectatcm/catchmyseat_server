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
if (!empty($_POST)) {
   $driver_id = filter_input(INPUT_POST,'driver_id');
        $latitude =filter_input(INPUT_POST,'latitude');
        $longitude =filter_input(INPUT_POST,'longitude');
       $driver->updateDriverStatus($driver_id,2);
      $driver->updateLocation($driver_id, "$latitude", "$longitude");
       $response['status'] = "success";
       $response['message'] = "Location updated";
        
}

echo json_encode($response);

