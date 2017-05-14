<?php

require_once 'DbConnection.php';

class Passenger extends Dbconnection {

    
    public function setPassengerData($name,$mobile,$password,$device_id,$fcm_id,$avatar) {
        $query = "insert into passenger set "
        . "                          name               = '$name'  ,"
        . "                          mobile             = '$mobile' ,"
        . "                          password           = '$password'   ,"
        . "                          device_id          = '$device_id'   ,"
        . "                          fcm_id             = '$fcm_id'   ,"
        . "                          avatar             = '$avatar'";
        return $this->setData($query);
    }

    public function passengerLogin($mobile, $password) {
        $query = "Select * from passenger where mobile = '$mobile' AND password = '$password'";
        return $this->getData($query);
    }
 public function deletePassenger($id){
        $query = "delete from passenger where id = '$id'";
       return $this->setData($query);
    }
    public function getPassengerDataByEmailId($email) {
        $query = "select * from passenger where email ='$email'";
        return $this->getData($query);
    }

    public function getPassengerDataById($id) {
        $query = "select * from passenger where id ='$id'";
        return $this->getData($query);
    }

    public function getAllPassengers() {
        $query = "select * from passenger order by id desc";
        return $this->getData($query);
    }
    
    public function updateFcmID($id,$fcm_id){
        $query = "UPDATE passenger set fcm_id = '$fcm_id' WHERE id = '$id'";
        return $this->setData($query);
    }

}
