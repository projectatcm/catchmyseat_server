<?php

require_once 'DbConnection.php';

class Passenger extends Dbconnection {

    
    public function setPassengerData($name,$email,$mobile,$password,$fcm_id,$avatar) {
        $query = "insert into passenger set "
                . "                          name               = '$name'  ,"
                . "                          mobile             = '$mobile' ,"
                . "                          email              = '$email' ,"
                . "                          password           = '$password'   ,"
                . "                          fcm_id             = '$fcm_id'   ,"
                . "                          avatar             = '$avatar'";
        return $this->setData($query);
    }

    public function passengerLogin($uname, $pwd) {
        $query = "Select * from passenger where email = '$uname' OR mobile = '$uname' AND password = '$pwd'";
        return $this->getData($query);
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
        $query = "select * from passenger ";
        return $this->getData($query);
    }

}
