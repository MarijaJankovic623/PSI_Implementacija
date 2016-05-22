<?php

/**
 * Description of business_logic
 *
 * @author Marija
 */
class BusinessLogic extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("my_database");
    }
      
    
    /**
     * 
     * @return array array of asociative arrays of restoran
     */
    public function getAllRestaurants() {
        $conn = $this->my_database->conn;
        $result = $conn->query("SELECT * FROM restoran");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    /**
     * 
     * @param string $id represents restaurants primary key 
     * @return array associative array od one restaurant
     */
    public function getRestaurant($id) {
        $conn = $this->my_database->conn;
        $result = $conn->query("SELECT * FROM restoran WHERE IDRestoran = ".$id);
        return $result->fetch_assoc();
    }

}
