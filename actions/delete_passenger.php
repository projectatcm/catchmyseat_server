<?php
require '../libs/Passenger.php';
$passenger = new Passenger();

if(!empty($_GET['id'])){
$id = $_GET['id'];
$passengerData = $passenger->getPassengerDataById($id);
$avatar = $passengerData[0]['avatar'];


if(!empty($avatar)){
    @unlink("../".$avatar);
}
print_r($passengerData);
$passenger->deletePassenger($id);
alert("Action Completed","../passengers.php");
}



function alert($message,$url){
    echo '<script>'
    . 'alert("'.$message.'");'
            . 'window.location = "'.$url.'";'
            . '</script>';
}
