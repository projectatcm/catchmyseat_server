<?php
require_once '../libs/PushMessage.php';
require_once '../libs/Drivers.php';
require_once '../libs/Passenger.php';
$pushMessage = new PushMessage();
$drivers  = new Drivers();
$passenger = new Passenger();


$user_id = $_POST['id'];
$title = $_POST['title'];
$message = $_POST['message'];
$user_type = $_POST['type'];

if($user_type == "driver"){
    $driver_data = $drivers->getDriverDataById($id);
    $driver_fcm_token = $driver_data[0]['fcm_id'];
    echo $driver_fcm_token;
}
exit();

$pushMessage->send(array(),array(
	'message' 	=> 'here is a message. message',
	'title'		=> 'This is a title. title',
	'subtitle'	=> 'This is a subtitle. subtitle',
	'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
	'vibrate'	=> 1,
	'sound'		=> 1,
	'largeIcon'	=> 'large_icon',
	'smallIcon'	=> 'small_icon'
));

?>