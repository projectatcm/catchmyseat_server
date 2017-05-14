<?php

require_once '../libs/PushMessage.php';
require_once '../libs/Drivers.php';
require_once '../libs/Passenger.php';
$pushMessage = new PushMessage();
$driver = new Drivers();
$passenger = new Passenger();
$response = array(
    "status" => "error",
    "message" => "",
    "data" => array()
);

function base64Image($image_path) {
    $data = file_get_contents($image_path);
    $base64 = base64_encode($data);
    return $base64;
}

if (!empty($_POST)) {
    $user_id = filter_input(INPUT_POST, 'user_id');
    $driver_id = filter_input(INPUT_POST, 'driver_id');
    $status = filter_input(INPUT_POST, 'status');
    if($status == "accepted"){
        $driver->updateDriverStatus($driver_id,3);
    }
    $driverData = $driver->getDriverDataById($driver_id);
    $userData = $passenger->getPassengerDataById($user_id);
    $driver_fcm = $userData[0]['fcm_id'];
    $user_id = $userData[0]['id'];
    $user_name = $userData[0]['name'];
    $driver_name = $driverData[0]['name'];
    $driver_id = $driverData[0]['id'];


//echo $userData[0]['avatar'];
    echo $pushMessage->send(array($driver_fcm), array(
        'type' => 'response',
        'id' => $user_id,
        'driver_name' => $driver_name,
        'status' => $status,
        'driver_id' => $driver_id
    ));
}
   