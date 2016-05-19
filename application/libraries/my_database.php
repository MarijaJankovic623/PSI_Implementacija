<?php

class My_database {

    public $conn;

    public function __construct() {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "restooking_baza";

        $this->conn = new mysqli($servername, $username, $password, $database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

}
