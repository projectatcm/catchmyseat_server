<?php

require_once('DbConnection.php');

class Admin extends DbConnection {

    function checkLogin($username, $password) {
        $data = $this->getData("SELECT * FROM login where username='$username' and password = '$password'");
            return $data;
        
    }

    function getUserData() {
        
    }

}
