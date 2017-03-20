<?php
require './libs/Drivers.php';
require './libs/Passenger.php';
$driver = new Drivers();
$passenger = new Passenger();
$response = array(
    "status" => "error",
    "message" => "",
    "data" => array()
);

if (!empty($_POST)) {
    $action =filter_input(INPUT_POST,'action');

    if ($action == "login_check") {
        $email =filter_input(INPUT_POST,'email');
        $password =filter_input(INPUT_POST,'password');
        $driverData = $driver->driverLogin($email, $password);
        $passengeData = $passenger->passengerLogin($email, $password);
        if (!empty($driverData)) {
            $driverData[0]['type'] = 'driver';
            $driverData[0]['photo'] = base64Image($driverData[0]['photo']);
            $response['status'] = "success";
            $response['message'] = "Loged as Driver";
            $response['data'] = $driverData;
        } else if (!empty($passengeData)) {
            $passengeData[0]['type'] = 'passenger';
            $passengeData[0]['photo'] = base64Image($passengeData[0]['photo']);
             $response['status'] = "success";
            $response['message'] = "Loged as Passenger";
            $response['data'] = $passengeData;
        } else {
           $response['message'] = "Sorry we can't find you account\nPlease try again";
        }

        echo json_encode($response);
    }
    if($action == "register_user"){
        $name = filter_input(INPUT_POST,"name");
        $email = filter_input(INPUT_POST,"email");
        $phone = filter_input(INPUT_POST,"phone");
        $password = filter_input(INPUT_POST,"password");
        $avatar = filter_input(INPUT_POST,"avatar");
        $fcm_id = filter_input(INPUT_POST,"fcm_id");
    }
    if ($action == "update_location") {
        $driver_id =filter_input(INPUT_POST,'id');
        $latitude =filter_input(INPUT_POST,'latitude');
        $longitude =filter_input(INPUT_POST,'longitude');
        $geo_data = $driver->getData("SELECT * FROM geo where driver_id = '$driver_id'");
        if(empty($geo_data)){
            $driver->setData("insert into geo set driver_id = '$driver_id'");
        }
        echo $driver->updateLocation($driver_id, "$latitude", "$longitude");
        echo "Updated ! $latitude | $longitude";
    }

    if ($action == "get_geo") {
        $data = $driver->getLocation('1');
        echo json_encode($data);
    }


    if ($action == "find_driver") {
        $latitude =filter_input(INPUT_POST,'latitude');
        $longitde =filter_input(INPUT_POST,'longitude');
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
$driver_data[0]['photo'] = base64Image($driver_data[0]['photo']);
$geo['distance'] = distance($latitude, $longitde, $driver_lat, $driver_lng, 'K');
$geo['data'] = $driver_data[0];
$data[] = $geo;
}
//        print_r($data);
//        exit();
echo json_encode($data);
}
if ($action == "driver_info") {
    $id =filter_input(INPUT_POST,'id');
//        echo "($latitude,$longitde)";
    $driver_data = $driver->getDriverDataById($id);
    $driver_data[0]['photo'] = base64Image($driver_data[0]['photo']);
    echo json_encode($driver_data[0]);
}

}
if(!empty($_GET)){
    $action = filter_input(INPUT_GET,'action');

}

function base64Image($image_path) {
    $data = file_get_contents($image_path);
    $base64 = base64_encode($data);
    return $base64;
}

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