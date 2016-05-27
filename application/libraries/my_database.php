<?php

class My_database {

    public $conn;

    public function __construct() {

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "restooking_baza";
        
        $servername2 = "us-cdbr-azure-west-c.cloudapp.net";
        $username2 = "b933519b206efa";
        $password2 = "5fda1cf3";
        $database2 = "restooking_baza";

        $this->conn = new mysqli($servername, $username, $password, $database);
        //$this->conn = new mysqli($servername2, $username2, $password2, $database2);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

}
