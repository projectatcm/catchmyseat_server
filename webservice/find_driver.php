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
function base64Image($image_path) {
    $data = file_get_contents($image_path);
    $base64 = base64_encode($data);
    return $base64;
}
function distance($lat1, $lon1, $lat2, $lon2, $unit) {
    /*
      This uses the ‘haversine’ formula to calculate the great-circle distance between two points – that is, the shortest distance over the earth’s surface – giving an ‘as-the-crow-flies’ distance between the points (ignoring any hills they fly over, of course!).
      Haversine formula:
      a = sin²(Δφ/2) + cos φ1 ⋅ cos φ2 ⋅ sin²(Δλ/2)
      c = 2 ⋅ atan2( √a, √(1−a) )
      d = R ⋅ c
      where 	φ is latitude, λ is longitude, R is earth’s radius (mean radius = 6,371km);
      note that angles need to be in radians to pass to trig functions!
     */
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

if (!empty($_POST)) {
    $latitude = filter_input(INPUT_POST, 'latitude');
    $longitde = filter_input(INPUT_POST, 'longitude');
    $geo_data = $driver->getData("SELECT * FROM geo");
    $data = array();
//        echo "($latitude,$longitde)";
    foreach ($geo_data as $geo) {
        $driver_id = $geo['driver_id'];
        $driver_lat = $geo['latitude'];
        $driver_lng = $geo['longitude'];
        $driver_data = $driver->getDriverDataById($driver_id);
        if (empty($driver_data)) {
            continue;
        }
        $driver_data[0]['avatar'] = base64Image('../'.$driver_data[0]['avatar']);
        $distance = distance($latitude, $longitde, $driver_lat, $driver_lng, 'K');
        $distance = round($distance,2);
        if($distance < 1){
         $distance = $distance * 100 ." meters";   
        }
        $geo['distance'] = $distance;
        $geo['data'] = $driver_data[0];
        $data[] = $geo;
    }
    if(!empty($data)){
        $response['data'] = $data;
        $response['status'] = "success";
        $response['message'] = "We found ".sizeof($data)." drivers in your area";
    }else{
         $response['message'] = "Sorry No drivers found !... we will update more";
    }
}

echo json_encode($response);



