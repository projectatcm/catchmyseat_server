<?php
require '../libs/Drivers.php';
$drivers = new Drivers();

if(!empty($_GET['id'])){
$id = $_GET['id'];
$driver_data = $drivers->getdriver($id);
$avatar = $driver_data[0]['avatar'];
$vehicle_image = $driver_data[0]['vehicle_image'];
$rc_book = $driver_data[0]['rc_book'];
$licence = $driver_data[0]['licence'];

if(!empty($avatar)){
    unlink("../".$avatar);
}
if(!empty($vehicle_image)){
    unlink("../".$vehicle_image);
}
if(!empty($rc_book)){
    unlink("../".$rc_book);
}
if(!empty($licence)){
    unlink("../".$licence);
}
print_r($driver_data);

$drivers->deleteDriver($id);
alert("Action Completed","../drivers.php?id=".$id);
}



function alert($message,$url){
    echo '<script>'
    . 'alert("'.$message.'");'
            . 'window.location = "'.$url.'";'
            . '</script>';
}
