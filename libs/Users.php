<?php

require_once 'Dbconnection.php';

class Users extends Dbconnection {

    public function login($uname, $pass) {
        $query = "select * from drivers where email ='$uname' AND password='$pass'";
        return $this->getData($query);
    }


}
