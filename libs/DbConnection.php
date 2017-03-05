<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DbConnection
 *
 * @author Sree
 */
class DbConnection {

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "catchmyseat_db";

    public $connection;

    public function __construct() {
       $this->connection = new mysqli($this->host,$this->username,$this->password,$this->database);
    }

    public function getData($query) {
        $result = mysqli_query($this->connection, $query) or die(mysqli_error($this->connection));
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function setData($query) {
        $result = mysqli_query($this->connection, $query);
        return mysqli_insert_id($this->connection);
    }

}
