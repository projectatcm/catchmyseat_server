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
    $id =filter_input(INPUT_POST,'driver_id');
    //        echo "($latitude,$longitde)";
        $driver_data = $driver->getDriverStatus($id);
   
        if(!empty($driver_data)){
        if($driver_data[0]['status'] == "1"){
            $response['status'] = "success";
            $response['message'] = "Your Account is Verified..";
        }else {
                $response['message'] = "Your Account is not verified yet !";
        }
    }else{
          $response['message'] = "Your Account is not verified yet !";
    }
   
}

echo json_encode($response);
