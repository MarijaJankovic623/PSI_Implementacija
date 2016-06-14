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
     * Dohvata sve podatke o restoranu.
     * 
     * Dohvata sve podatke o restoranu za prosledjeni
     * rimarni kljuci, i vraca ih u obliku asicojativnog niza
     * gde svaki element niza predstavlja jednu kolonu.
     * 
     * @param string $id  Primarni kljuc restorana koji se dohvata
     * @return array Restoran, tj asocijativni niz njegovih kolona
     */
    public function getRestaurant($id) {
        $conn = $this->my_database->conn;
        $result = $conn->query("SELECT * FROM restoran WHERE IDRestoran = " . $id);
        return $result->fetch_assoc();
    }

    /**
     * Dohvata podatke o svim restoranima.
     * 
     * Dohvata podatke o svim restoranima iz baze,
     * i vraca ih kao niz asocijativnih nizova, 
     * gde se svaki asocijativni niz sastoji od 
     * elemenata koji su kolone tabele
     * 
     * @return array Niz asocijativnih nizova koji su restorani, 
     * sa elementima tipa kolona
     */
    public function getAllRestaurants() {
        $conn = $this->my_database->conn;
        $result = $conn->query("SELECT * FROM restoran");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Vraca restorane koji imaju slobodne stolove
     * za zadate kriterijume.
     * 
     * Funkcija pretrazuje restorane u odredjenoj 
     * opstini, i proverava da li u toj opstini postoje
     * slobodni stolovi u odredjenom periodu za odredjeni 
     * broj ljudi.
     * 
     * @param string $opstina Opstina na kojoj pretrazujemo restoran
     * @param string $brLjudi Broj ljudi koji zele da rezervisu sto
     * @param string $vremeOd Zeljeno vreme pocetka
     * @param string $vremeDo Zeljeno vreme kraja
     * @return array Niz asocijativnih nizova koji su restorani, 
     * sa elementima tipa kolona
     */
    public function getCriteriaRestaurants($opstina, $brLjudi, $vremeOd, $vremeDo) {
        if ($brLjudi <= 2)
            $brLjudi = 2;
        else if ($brLjudi > 2 && $brLjudi <= 4)
            $brLjudi = 4;
        else if ($brLjudi > 4)
            $brLjudi = 6;

        $vremeOd = date("Y-m-d H:i", strtotime($vremeOd));
        $vremeDo = date("Y-m-d H:i", strtotime($vremeDo));

        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $stmt->prepare("CALL slobodni_stolovi_restorani(?,?,?,?)");
        $stmt->bind_param("siss", $opstina, $brLjudi, $vremeOd, $vremeDo);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    
    /**
     * Rezervise sto.
     * 
     * Funkcija vrsi proveru da li postoji slobodan
     * sto za odredjeni broj ljudi, u odredjenom vremenu
     * i za odredjeni restoran, i ukoliko postoji ona 
     * vrsi rezervaciju i vraca true, u suprotnom false
     * 
     * @param inteeger $idRestorana Primarni kljuc restorana
     * @param string $brLjudi Broj ljudi za koji se rezervise sto
     * @param type $vremeOd Zeljeno vreme pocetka
     * @param string $vremeDo Zeljeno vreme kraja
     * @return boolean Informacija o uspehu ili neuspehu rezervacije
     */

    public function reserveTable($idRestorana, $brLjudi, $vremeOd, $vremeDo) {
        if ($brLjudi <= 2)
            $brLjudi = 2;
        else if ($brLjudi > 2 && $brLjudi <= 4)
            $brLjudi = 4;
        else if ($brLjudi > 4)
            $brLjudi = 6;

        $vremeOd = date("Y-m-d H:i", strtotime($vremeOd));
        $vremeDo = date("Y-m-d H:i", strtotime($vremeDo));

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

        $vremeOd = date("Y-m-d H:i", strtotime($vremeOd));
        $vremeDo = date("Y-m-d H:i", strtotime($vremeDo));

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

    public function getNumberOfTables($id, $n) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $stmt->prepare("SELECT * FROM sto WHERE IDRestoranFK=? AND BrojOsoba=?");
        $stmt->bind_param("ii", $id, $n);
        $stmt->execute();
        $result = $stmt->get_result()->num_rows;
        return $result;
    }

    
    /**
     * Proverava da li je uneto validno vreme za pocetak i kraj rezervacije
     * 
     * Funkcija vrsi proveru da datum prijave ne bude nakon datuma odlaska, 
     * da razlika izmedju prijave i odjave ne bude vise od 6 sati, 
     * i da datum prijave a samim tim i odjave bude nakon trenutnog vremena
     * Ukoliko su svi kriterijumi ispunjeni vraca true a ukoliko nisu false
     * 
     * 
     * @param Date $date1
     * @param Date $date2
     * @return boolean vraca true ukoliko su vremena u redu, a false ukoliko nisu
     */
    public function checkDate($date1, $date2) {
        date_default_timezone_set('Europe/Belgrade');
        $date = date("Y-m-d H:i", time());

        if ($date1 >= $date2) {

            return false;
        }
        if (($date2 - $date1) > (60 * 60 * 6)) {
            return false;
        }

        if ($date1 < $date)
            return false;
        else
            return true;
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
    
    
    /**
     * Za odredjenog korisnika dohvata sve njegove rezervacije
     * 
     * Za oredjenog korisnika dohvata sve informacije o svim njegovim rezervacijama
     * 
     * @param type $idUser id korisnika za kog zelimo da dohvatimo sve rezervacije neovisno od njihovog statusa
     * 
     * @return array asocijativni niz rezervacija (sve informacije o rezervaciji koje se nalaze i u bazi)
     */

    public function getAllReservations($idUser) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $result = $conn->query("CALL sve_rezervacije(" . $idUser . ")");

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    /**
     * Ocenjuje rezervaciju od strane korisnika
     * 
     * Ocenjuje rezervaciju od strane korisnika ciiji je status 'Ostvarena', upisuje ocenu, azurira i prosecnu ocenu restorana 
     * za kog je rezervacija napravljena, i status rezervacije menja u 'Ocenjena'
     * 
     * @param type $rezervacija asocijativni niz rezervacija koji sadrzi id rezervacije koju zelimo da ocenimo kao i samu ocenu
     */

    public function rezervacijaGrade($rezervacija) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();

        $stmt->prepare("UPDATE rezervacija  SET Status = 'Ocenjena',  Ocena = ? WHERE IDRezervacija=?");
        $stmt->bind_param("ii", $rezervacija['ocena'], $rezervacija['idrezervacija']);
        $stmt->execute();

        $stmt = $conn->stmt_init();
        $result = $conn->query("CALL ocena_restorana(" . $rezervacija['idrezervacija'] . ")");
    }

    
    /**
     * Otkazuje rezervaciju od strane korisnika
     * 
     * U bazi u tabeli rezervacija menja status na 'Otkazana'
     * 
     * @param array $rezervacija asocijativni niz rezervacija koji sadrzi id rezervacije koju zelimo da obrisemo
     * @return boolean vraca u obliku true/false uspesnost otkazivanja trenutno uvek vraca true jer ne postoji mogucnost da vrati false
     */
    public function rezervacijaCancel($rezervacija) {

        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();

        $stmt->prepare("UPDATE rezervacija SET Status = 'Otkazana'  WHERE IDRezervacija=?");
        $stmt->bind_param("i", $rezervacija['idrezervacija']);
        $stmt->execute();
        return true;
    }
    
    /**
     * Dohvata slike.
     * 
     * Dohvata niz asocijativnih nizova, gde u 
     * svakom asocijativnom nizu stoji putanja do slike
     * 
     * @param integer $idRestoran Id restorana za koji dohvatamo slike
     * @return array niz asocijativnih nizova koji su slike, 
     * sa elementima tipa kolona
     */
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
