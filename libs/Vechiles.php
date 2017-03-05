<?php

require_once 'Dbconnection.php';

class Vechiles extends Dbconnection {

    public function getAllVechiles() {
        $query = "select * from vechile ";
        return $this->getData($query);
    }

    public function getById($id) {
        $query = "select * from `vechile` where `id`=$id ";
        return $this->getById($query);
    }

}
