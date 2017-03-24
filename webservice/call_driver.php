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
    $destination = filter_input(INPUT_POST, 'destination');
    $driverData = $driver->getDriverDataById($driver_id);
    $userData = $passenger->getPassengerDataById($user_id);
    $driver_fcm = $driverData[0]['fcm_id'];
    $user_id = $userData[0]['id'];
    $user_name = $userData[0]['name'];


//echo $userData[0]['avatar'];
    echo $pushMessage->send(array($driver_fcm), array(
        'type' => 'call',
        'id' => $user_id,
        'name' => $user_name,
        'destination' => $destination,
        'latitude' => 'asd',
        'longitude' => 'asd'
    ));
}
   