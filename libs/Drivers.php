<?php

require_once 'DbConnection.php';

class Drivers extends Dbconnection {
    public function setDriverData($name, $vehicle, $mobile, $email,$password,$gcm_id,$status) {
        $query = "insert into drivers set "
                . "                          name               = '$name'  ,"
                . "                          vehicle_no         = '$vehicle' ,"
                . "                          mobile             = '$mobile' ,"
                . "                          email              = '$email' ,"
                . "                          password           = '$password'   ,"
                . "                          gcm_id             = '$gcm_id'   ,"
                . "                          status             = '$status'";
        return $this->setData($query);
    }
    public function driverLogin($uname, $pwd) {
        $query = "Select * from drivers where email = '$uname' OR mobile = '$uname' AND password = '$pwd'";
        return $this->getData($query);
    }
    public function getDrivers($id) {
        $query = "select * from drivers where id ='$id'";
        return $this->getData($query);
    } 
    public function getDriverDataById($id) {
        $query = "select * from drivers where id ='$id'";
        return $this->getData($query);
    }   
    public function updateLocation($driver_id,$latitude,$longitude){
        $geo_data = $this->getData("SELECT * FROM geo where driver_id = '$driver_id'");
        if(empty($geo_data)){
           $this->getData("INSERT INTO geo set driver_id = '$driver_id'"); 
        }else{
             $this->getData("UPDATE geo set latitude = '$latitude',longitude = '$longitude' where driver_id = '$driver_id'"); 
        }
    }  
     public function setData($query) {
        $response = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
        return mysqli_insert_id($this->connection);
    }
}
