<?php
require_once '../libs/PushMessage.php';
require_once '../libs/Drivers.php';
require_once '../libs/Passenger.php';
$pushMessage = new PushMessage();
$drivers  = new Drivers();
$passenger = new Passenger();


$id = $_POST['id'];
$title = $_POST['title'];
$message = $_POST['message'];
$user_type = $_POST['type'];
$fcm_id = "";
if($user_type == "driver"){
    $driver_data = $drivers->getDriverDataById($id);
    $driver_fcm_token = $driver_data[0]['fcm_id'];
    $fcm_id = $driver_fcm_token;
}
if($user_type == "passenger"){
    $driver_data = $passenger->getPassengerDataById($id);
    $driver_fcm_token = $driver_data[0]['fcm_id'];
    $fcm_id = $driver_fcm_token;
}

$pushMessage->send(array($fcm_id),array(
    'type'	=> 'notification',
	'message' 	=> $message,
	'title'		=> $title,
	'subtitle'	=> 'This is a subtitle. subtitle',
	'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
	'vibrate'	=> 1,
	'sound'		=> 1,
	'largeIcon'	=> 'large_icon',
	'smallIcon'	=> 'small_icon'
));
echo "<script>"
. "alert('Message sended !');"
        . "window.history.back();"
        . "</script>";
