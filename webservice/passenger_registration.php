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
    $avatar = filter_input(INPUT_POST,"avatar");
    $device_id = filter_input(INPUT_POST,"device_id");
    $fcm_id = filter_input(INPUT_POST,"fcm_id");
    $avatar_save_path = "files/passenger/" . $name.uniqid().".jpg";
    if($avatar != ""){
        imagecompress(base64_to_jpeg($avatar, "../files/tmp.jpg"), "../".$avatar_save_path, 100);
    }else{
       $avatar_save_path = "";
   }
   $user_id = $passenger->setPassengerData($name, $mobile, $password, $avatar_save_path, $device_id,$fcm_id);
   if($user_id){
    $response['status'] = "success";
    $response['message'] = "Welcome to Catch My Ride !";
    $response['data'] = array(
        "id" => $user_id,
        "name" => $name
        );
}
}

echo json_encode($response);

