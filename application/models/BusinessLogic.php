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
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
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
            $stmt->prepare("SELECT * FROM admin WHERE IDAdmin=?");
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $res = $stmt->get_result()->fetch_assoc();
        return $res;
    }

    public function getAllWaiters($id) {
        $conn = $this->my_database->conn;
        $result = $conn->query("SELECT * FROM konobar WHERE IDRestoranFK = " . $id);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteWaiter($id) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $stmt->prepare("DELETE FROM konobar WHERE IDKonobar=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $test = $conn->stmt_init();
        $test->prepare("SELECT * FROM konobar WHERE IDKonobar=?");
        $test->bind_param("i", $id);
        $test->execute();

        if ($test->get_result()->num_rows > 0) {
            return false;
        } else {
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

    public function getNumberOfTables($id, $n) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $stmt->prepare("SELECT * FROM sto WHERE IDRestoranFK=? AND BrojOsoba=?");
        $stmt->bind_param("ii", $id, $n);
        $stmt->execute();
        $result = $stmt->get_result()->num_rows;
        return $result;
    }

    public function getCriteriaRestaurants($opstina, $brLjudi, $vremeOd, $vremeDo) {
        if ($brLjudi <= 2)
            $brLjudi = 2;
        else if ($brLjudi > 2 && $brLjudi <= 4)
            $brLjudi = 4;
        else if ($brLjudi > 4 && $brLjudi <= 6)
            $brLjudi = 6;

        $vremeOd = date("Y-m-d h:i", strtotime($vremeOd));
        $vremeDo = date("Y-m-d h:i", strtotime($vremeDo));

        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $stmt->prepare("CALL slobodni_stolovi_restorani(?,?,?,?)");
        $stmt->bind_param("siss", $opstina, $brLjudi, $vremeOd, $vremeDo);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function checkDate($date1, $date2) {
        date_default_timezone_set('Europe/Belgrade');
        $date = date("Y-m-d h:i", time());

        if ($date1 >= $date2) {

            return false;
        }
        if (($date2 - $date1) > (60 * 60 * 6)) {
            return false;
        }
        
        if($date1<$date) return false;
        else return true;
    }

    public function reserveTable($idRestorana, $brLjudi, $vremeOd, $vremeDo) {
        if ($brLjudi <= 2)
            $brLjudi = 2;
        else if ($brLjudi > 2 && $brLjudi <= 4)
            $brLjudi = 4;
        else if ($brLjudi > 4 && $brLjudi <= 6)
            $brLjudi = 6;

        $vremeOd = date("Y-m-d h:i", strtotime($vremeOd));
        $vremeDo = date("Y-m-d h:i", strtotime($vremeDo));

        if ($this->checkDate($vremeOd, $vremeDo)) {

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
                $stmt->prepare("INSERT INTO rezervacija(IDStoFK,IDKorisnikFK,VremeOd,VremeDo,Status) VALUES(?,?,?,?,'Nadolazeca')");
                $stmt->bind_param("iiss", $sto['IDSto'], $userid, $vremeOd, $vremeDo);
                $stmt->execute();


                return true;
            }
        }

        return false;
    }

    public function getAllUsers() {
        $conn = $this->my_database->conn;
        $result = $conn->query("SELECT * FROM korisnik");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteUser($idUser) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $stmt->prepare("DELETE FROM korisnik WHERE IDKorisnik=?");
        $stmt->bind_param("i", $idUser);
        $stmt->execute();

        $result = $conn->stmt_init();
        $result->prepare("SELECT * FROM korisnik WHERE IDKorisnik=?");
        $result->bind_param("i", $idUser);
        $result->execute();

        if ($result->get_result()->num_rows > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function freeTables($id, $brLjudi, $vremeOd, $vremeDo, $korisnik) {

        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $stmt->prepare("SELECT * FROM konobar WHERE IDKonobar=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();

        if ($brLjudi <= 2)
            $brljudi = 2;
        else if ($brLjudi > 2 && $brLjudi <= 4)
            $brLjudi = 4;
        else if ($brLjudi > 4 && $brLjudi <= 6)
            $brLjudi = 6;

        $vremeOd = date("Y-m-d h:i", strtotime($vremeOd));
        $vremeDo = date("Y-m-d h:i", strtotime($vremeDo));
        
        if ($this->checkDate($vremeOd, $vremeDo)) {
        
            $conn = $this->my_database->conn;
            $stmt = $conn->stmt_init();
            $stmt->prepare("CALL slobodni_stolovi(?,?,?,?)");
            $stmt->bind_param("iiss", $result['IDRestoranFK'], $brLjudi, $vremeOd, $vremeDo);
            $stmt->execute();

            $sto = $stmt->get_result()->fetch_assoc();
            if (isset($sto['IDSto'])) {

                $conn = $this->my_database->conn;
                $stmt = $conn->stmt_init();
                $stmt->prepare("SELECT * FROM korisnik WHERE KIme=?");
                $stmt->bind_param("s", $korisnik['imeKorisnika']);
                $stmt->execute();

                $idKorisnika = $stmt->get_result()->fetch_assoc();

                $conn = $this->my_database->conn;
                $stmt = $conn->stmt_init();
                $stmt->prepare("INSERT INTO rezervacija(IDStoFK,IDKorisnikFK,VremeOd,VremeDo,Status) VALUES(?,?,?,?,'Nadolazeca')");
                $stmt->bind_param("iiss", $sto['IDSto'], $idKorisnika['IDKorisnik'], $vremeOd, $vremeDo);
                $stmt->execute();

                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function getReservations() {

        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $id = $this->session->userdata('userid');
        $stmt->prepare("SELECT * FROM konobar WHERE IDKonobar=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        $conn = $this->my_database->conn;
        $stol = $conn->query("SELECT * FROM sto WHERE IDRestoranFK=" . $result['IDRestoranFK']);
        $stolovi = $stol->fetch_all(MYSQLI_ASSOC);

        $conn = $this->my_database->conn;
        $rezer = $conn->query("SELECT * FROM rezervacija WHERE Status = 'Nadolazeca'");
        $rezervacije = $rezer->fetch_all(MYSQLI_ASSOC);
        $index = 0;
        $data = array();
        foreach ($stolovi as $sto) {
            foreach ($rezervacije as $rez) {
                if ($sto['IDSto'] == $rez['IDStoFK']) {

                    $conn = $this->my_database->conn;
                    $stmt = $conn->stmt_init();
                    $stmt->prepare("SELECT * FROM sto WHERE IDSto=?");
                    $stmt->bind_param("i", $rez['IDStoFK']);
                    $stmt->execute();
                    $table = $stmt->get_result()->fetch_assoc();
                    $rez['brojLjudi'] = $table['BrojOsoba'];
                    $data[$index] = $rez;
                    ++$index;
                }
            }
        }
        return $data;
    }

    public function oslobodi($rez) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $stmt->prepare("UPDATE rezervacija SET Status='Ostvarena' WHERE IDRezervacija=?");
        $stmt->bind_param("i", $rez);
        $stmt->execute();

      
        return true;
    }

    public function getNameRestaurant() {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $idKonobar = $this->session->userdata('userid');
        $stmt->prepare("SELECT * FROM konobar WHERE IDKonobar=?");
        $stmt->bind_param("i", $idKonobar);
        $stmt->execute();

        $konobar = $stmt->get_result()->fetch_assoc();
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $stmt->prepare("SELECT * FROM restoran WHERE IDRestoran=?");
        $stmt->bind_param("i", $konobar['IDRestoranFK']);
        $stmt->execute();

        $restoran = $stmt->get_result()->fetch_assoc();
        return $restoran['ImeObjekta'];
    }

    public function getAllReservations($idUser) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $result = $conn->query("CALL sve_rezervacije(" . $idUser . ")");

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function rezervacijaGrade($rezervacija) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();

        $stmt->prepare("UPDATE rezervacija  SET Status = 'Ocenjena',  Ocena = ? WHERE IDRezervacija=?");
        $stmt->bind_param("ii", $rezervacija['ocena'], $rezervacija['idrezervacija']);
        $stmt->execute();

        $stmt = $conn->stmt_init();
        $result = $conn->query("CALL ocena_restorana(" . $rezervacija['idrezervacija'] . ")");
    }

    public function rezervacijaCancel($rezervacija) {

        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();

        $stmt->prepare("UPDATE rezervacija SET Status = 'Otkazana'  WHERE IDRezervacija=?");
        $stmt->bind_param("i", $rezervacija['idrezervacija']);
        $stmt->execute();
        return true;
    }
    
    public function getSlike($idRestoran) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        
        $stmt->prepare("SELECT * FROM slika WHERE IDRestoranFK=?");
        
        $stmt->bind_param("i", $idRestoran);
        $stmt->execute();

        $res = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $res;
        
        
        
    }

}
