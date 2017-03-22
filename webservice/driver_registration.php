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
// function to covert base64 string to image
function base64_to_jpeg($base64_string, $output_file) {
    $ifp = fopen($output_file, "wb");
    fwrite($ifp, base64_decode($base64_string));
    fclose($ifp);
    return $output_file;
}
// function to reduce the size and quality of the image
function imagecompress($source, $destination, $quality) {
    $info = getimagesize($source);
    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source);
    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source);
    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source);
    imagejpeg($image, $destination, $quality);
    unlink($source);
    return $destination;
}
if (!empty($_POST)) {
    $name = filter_input(INPUT_POST,"name");
    $mobile = filter_input(INPUT_POST,"mobile");
    $password = filter_input(INPUT_POST,"password");
    $device_id = filter_input(INPUT_POST,"device_id");
    $fcm_id = filter_input(INPUT_POST,"fcm_id");
    $vehicle_no = filter_input(INPUT_POST,"vehicle_no");
    $vehicle_type = filter_input(INPUT_POST,"vehicle_type");
    $vehicle_name = filter_input(INPUT_POST,"vehicle_name");
  $rc_book = filter_input(INPUT_POST,"rc_book");
    $licence = filter_input(INPUT_POST,"licence");
    $avatar = filter_input(INPUT_POST,"avatar");
    $vehicle_image = filter_input(INPUT_POST,"vehicle_image");
    //$status = filter_input(INPUT_POST,"fcm_id");
    $avatar_save_path = "files/driver/" . $name.uniqid().".jpg";
    $vehicle_save_path = "files/vehicle/" . $name.uniqid().".jpg";
    $licence_save_path = "files/licence/" . $name.uniqid().".jpg";
    $rc_book_save_path = "files/rc_book/" . $name.uniqid().".jpg";

    if($avatar != ""){
        imagecompress(base64_to_jpeg($avatar, "../files/tmp.jpg"), "../".$avatar_save_path, 100);
    }else{
       $avatar_save_path = "";
   }
    if($vehicle_image != ""){
        imagecompress(base64_to_jpeg($vehicle_image, "../files/tmp.jpg"), "../".$vehicle_save_path, 100);
    }else{
       $vehicle_save_path = "";
   }
     if($licence != ""){
        imagecompress(base64_to_jpeg($licence, "../files/tmp.jpg"), "../".$licence_save_path, 100);
    }else{
       $licence_save_path = "";
   }
    if($rc_book != ""){
        imagecompress(base64_to_jpeg($rc_book, "../files/tmp.jpg"), "../".$rc_book_save_path, 100);
    }else{
       $rc_book_save_path = "";
   }
   $driver_id = $driver->setDriverData($name, $mobile, $password,$avatar_save_path,$licence_save_path,$rc_book_save_path,$fcm_id,$device_id,$vehicle_no,$vehicle_type,$vehicle_name,$vehicle_save_path,'0');
   if($driver_id){
    $response['status'] = "success";
    $response['message'] = "Welcome to Catch My Ride !";
    $response['data'] = array(
        "id" => $driver_id,
        "name" => $name,
        "status" => "0"
        );
}
}

echo json_encode($response);

