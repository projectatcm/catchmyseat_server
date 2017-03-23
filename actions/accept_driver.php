<?php
require '../libs/Drivers.php';
$drivers = new Drivers();

if(!empty($_GET['id'])){
$id = $_GET['id'];
$drivers->acceptDriver($id);
alert("Action Completed","../driver_view.php?id=".$id);
}



function alert($message,$url){
    echo '<script>'
    . 'alert("'.$message.'");'
            . 'window.location = "'.$url.'";'
            . '</script>';
}
