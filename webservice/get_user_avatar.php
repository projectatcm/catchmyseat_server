<?php

require_once '../libs/Passenger.php';
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
    $user_id = filter_input(INPUT_POST, 'id');
    $userData = $passenger->getPassengerDataById($user_id);
    $user_id = $userData[0]['id'];
    $user_avatar = $userData[0]['avatar'];
    if (!empty($user_avatar)) {
        $user_avatar = base64Image('../' . $userData[0]['avatar']);
    } else {
        $user_avatar = "";
    }
    echo json_encode(array(
        "avatar" => $user_avatar,
    ));
}
   