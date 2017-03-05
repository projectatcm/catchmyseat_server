<?php
error_reporting(0);
require './libs/Drivers.php';
require './libs/Passenger.php';
$driver = new Drivers();
$passenger = new Passenger();


if (!empty($_POST)) {
    $action = $_POST['action'];
    if ($action == "update_location") {
        $driver_id = $_POST['id'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
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

    if ($action == "login_check") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $driverData = $driver->driverLogin($email, $password);
        $passengeData = $passenger->passengerLogin($email, $password);
        $data = array();
        $data['status'] = "ok";
        if (!empty($driverData)) {
            $driverData[0]['type'] = 'driver';
            $driverData[0]['photo'] = base64Image($driverData[0]['photo']);
            $data['response'] = $driverData[0];
        } else if (!empty($passengeData)) {
            $passengeData[0]['type'] = 'passenger';
            $passengeData[0]['photo'] = base64Image($passengeData[0]['photo']);
            $data['response'] = $passengeData[0];
        } else {
            $data['status'] = "error";
        }

        echo json_encode($data);
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
        $id = $_POST['id'];
//        echo "($latitude,$longitde)";
        $driver_data = $driver->getDriverDataById($id);
        $driver_data[0]['photo'] = base64Image($driver_data[0]['photo']);
        echo json_encode($driver_data[0]);
    }
} else {
    echo "NO Post data available !";
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