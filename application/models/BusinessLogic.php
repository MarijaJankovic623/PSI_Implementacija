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
    
    public function getUser($id) {
        $conn=$this->my_database->conn;
        $stmt=$conn->stmt_init();
        if ($this->session->userdata('korisnik')) {
            $stmt->prepare("SELECT * FROM korisnik WHERE IDKorisnik=?");
        }
        if ($this->session->userdata('restoran')) {
            $stmt->prepare("SELECT * FROM restoran WHERE IDRestoran=?");
        }
        if ($this->session->userdata('konobar')) {
            $stmt->prepare("SELECT * FROM konobar WHERE IDKonobar=?");
        }
        if ($this->session->userdata('admin')) {
            $stmt->prepare("SELECT * FROM korisnik WHERE IDKorisnik=?");
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    
    public function getAllWaiters($id) {
        $conn=$this->my_database->conn;
        $result=$conn->query("SELECT * FROM konobar WHERE IDRestoranFK = ".$id);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function deleteWaiter($id) {
        $conn=$this->my_database->conn;
        $stmt=$conn->stmt_init();
        $stmt->prepare("DELETE FROM konobar WHERE IDKonobar=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $test=$conn->stmt_init();
        $test->prepare("SELECT * FROM konobar WHERE IDKonobar=?");
        $test->bind_param("i", $id);
        $test->execute();
        
        if($test->get_result()->num_rows>0) {
            return false;
        }
        else {
            return true;
        }
    }
    
    /**
     * 
     * @param string $id represents restaurants primary key 
     * @return array associative array od one restaurant
     */
    public function getRestaurant($id) {
        $conn = $this->my_database->conn;
        $result = $conn->query("SELECT * FROM restoran WHERE IDRestoran = " . $id);
        return $result->fetch_assoc();
    }

    public function reserveTable($idRestorana, $brLjudi, $vremeOd, $vremeDo) {
        $brLjudi = ($brLjudi <= 2)? 2:($brLjudi<=4)? 4: 6;//ovo je jer u bazi stoje 2 4 ili 6 za kapacitete stolova
        $vremeOd = date("Y-m-d h:i", strtotime($vremeOd));
        $vremeDo = date("Y-m-d h:i", strtotime($vremeDo));
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $stmt->prepare("CALL slobodni_stolovi(?,?,?,?)");
        $stmt->bind_param("iiss", $idRestorana, $brLjudi, $vremeOd, $vremeDo);
        $stmt->execute();

        $sto = $stmt->get_result()->fetch_assoc();
        if (isset($sto['IDSto'])) {
            $userid = $this->session->userdata('userid');
            
            $conn = $this->my_database->conn;
            $stmt = $conn->stmt_init();
            $stmt->prepare("INSERT INTO rezervacija(IDStoFK,IDKorisnikFK,VremeOd,VremeDo) VALUES(?,?,?,?)");
            $stmt->bind_param("iiss", $sto['IDSto'], $userid, $vremeOd, $vremeDo);
            $stmt->execute();


            return true;
        }

        return false;
    }

}
