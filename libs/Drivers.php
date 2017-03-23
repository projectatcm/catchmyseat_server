<?php

require_once 'DbConnection.php';

class Drivers extends Dbconnection {
    public function setDriverData($name, $mobile, $password,$avatar,$licence,$rc_book,$fcm_id,$device_id,$vehicle_no,$vehicle_type,$vehicle_name,$vehicle_image,$status) {
        $query = "insert into driver set "
                . "                          name               = '$name',"
                . "                          mobile             = '$mobile',"
                . "                          password           = '$password',"
                . "                          avatar             = '$avatar',"
                . "                          licence            = '$licence',"
                . "                          rc_book            = '$rc_book',"
                . "                          fcm_id             = '$fcm_id',"
                . "                          device_id             = '$device_id',"
                . "                          vehicle_no         = '$vehicle_no',"
                . "                          vehicle_type       = '$vehicle_type',"
                . "                          vehicle_name       = '$vehicle_name',"
                . "                          vehicle_image       = '$vehicle_image',"
                . "                          status             = '$status'";
        return $this->setData($query);
    }
    public function driverLogin($mobile, $password) {
        $query = "Select * from driver where mobile = '$mobile' AND password = '$password'";
        return $this->getData($query);
    }
    public function getdriver($id = "") {
       if($id != ""){
            $query = "select * from driver where id ='$id'";
       }else{
            $query = "select * from driver order by id desc";
       }
        return $this->getData($query);
    }
    public function getDriverDataById($id) {
        $query = "select * from driver where id ='$id'";
        return $this->getData($query);
    }
    public function updateLocation($driver_id,$latitude,$longitude){
        $geo_data = $this->getData("SELECT * FROM geo where driver_id = '$driver_id'");
        if(empty($geo_data)){
           $this->setData("INSERT INTO geo set driver_id = '$driver_id'");
        }else{
             $this->setData("UPDATE geo set latitude = '$latitude',longitude = '$longitude' where driver_id = '$driver_id'");
        }
    }

    public function acceptDriver($id){
        $query = "UPDATE driver set status = '1' where id = '$id'";
       return $this->setData($query);
    }
     public function deleteDriver($id){
        $query = "delete from driver where id = '$id'";
       return $this->setData($query);
    }

    public function getLocation($id){
         $query = "select * from geo where driver_id ='$id'";
        return $this->getData($query);
    }

    public function setData($query) {
        $response = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
        return mysqli_insert_id($this->connection);
    }

    public function getDriverStatus($id){
        $query = "select status from driver where id ='$id'";
       return $this->getData($query);
    }
     public function updateFcmID($id,$fcm_id){
        $query = "UPDATE driver set fcm_id = '$fcm_id' WHERE id = '$id'";
        return $this->setData($query);
    }

}
