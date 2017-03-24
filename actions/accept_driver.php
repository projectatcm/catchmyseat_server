<?php
require '../libs/Drivers.php';
$drivers = new Drivers();
require_once '../libs/PushMessage.php';
$pushMessage = new PushMessage();
if(!empty($_GET['id'])){
$id = $_GET['id'];
$driver_data = $drivers->getDriverDataById($id);
    $driver_fcm_token = $driver_data[0]['fcm_id'];
    $fcm_id = $driver_fcm_token;
$drivers->acceptDriver($id);

$pushMessage->send(array($fcm_id),array(
    	'type'	=> 'notification',
	'message' 	=> "Your Profile is Verified",
	'title'		=> "Welcome",
	'subtitle'	=> 'This is a subtitle. subtitle',
	'vibrate'	=> 1,
	'sound'		=> 1,
	'largeIcon'	=> 'large_icon',
	'smallIcon'	=> 'small_icon'
));
alert("Action Completed","../driver_view.php?id=".$id);
}



function alert($message,$url){
    echo '<script>'
    . 'alert("'.$message.'");'
            . 'window.location = "'.$url.'";'
            . '</script>';
}


