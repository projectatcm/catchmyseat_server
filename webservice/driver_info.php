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
// function to convert image file into base64 string
function base64Image($image_path) {
    $data = file_get_contents($image_path);
    $base64 = base64_encode($data);
    return $base64;
}

if (!empty($_POST)) {
    $id =filter_input(INPUT_POST,'id');
//        echo "($latitude,$longitde)";
    $driver_data = $driver->getDriverDataById($id);
    $driver_data[0]['photo'] = base64Image($driver_data[0]['photo']);
    echo json_encode($driver_data[0]);       
}

echo json_encode($response);

