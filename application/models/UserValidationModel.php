<?php

/**
 * Description of registrationModel
 *
 * @author Marija
 */
class UserValidationModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("my_database");
    }

    /**
     * Provera sesije za sve vrste korisnika.
     * 
     * Poziva se unutar ostalih funkcija za proveru sesija
     * ona proverava samo da li je korisnik koji pokusava da prostupi
     * ulogovan i ako nije vraca ga na pocetnu stranu sistema.
     * 
     * 
     */
    public function checkSession() {
        $is_logged_in = $this->session->userdata('loggedIn');


        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect("ErrorCtrl");
        }
    }

    public function checkSessionKorisnik() {
        $this->checkSession();
        $korisnik = $this->session->userdata('korisnik');

        if (!$korisnik) {
            redirect("ErrorCtrl");
        }
    }

    public function checkSessionRestoran() {
        $this->checkSession();
        $restoran = $this->session->userdata('restoran');

        if (!$restoran) {
            redirect("ErrorCtrl");
        }
    }

    public function checkSessionKonobar() {
        $this->checkSession();
        $konobar = $this->session->userdata('konobar');

        if (!$konobar) {
            redirect("ErrorCtrl");
        }
    }

    public function checkSessionAdmin() {
        $this->checkSession();
        $admin = $this->session->userdata('admin');

        if (!$admin) {
            redirect("ErrorCtrl");
        }
    }

    /**
     * Logovanje korisnika.
     * 
     * Proverava da li korisnik sa datim imenom i sifrom
     * postoji, i ako postoji puni podatke o sesiji i vraca
     * poruku o uspehu, u suprotnom o neuspehu.
     * 
     * @param string $kime Korisnicko ime
     * @param string $lozinka Korisnicka lozinka
     * @return boolean Informacija o uspehu logovanja
     */
    public function loginKorisnik($kime, $lozinka) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init(); //dohvatanje iskaza
        $stmt->prepare("SELECT * FROM korisnik WHERE KIme = ? AND Lozinka = ?"); //pravljenje istog
        $stmt->bind_param("ss", $kime, $lozinka); //vezivanej parametara 
        $stmt->execute();

        $kor = $stmt->get_result()->fetch_assoc();
        if (isset($kor['IDKorisnik'])) {
            $data = array(
                'userid' => $kor['IDKorisnik'],
                'username' => $kime,
                'loggedIn' => true,
                'korisnik' => true,
                'restoran' => false,
                'konobar' => false,
                'admin' => false
            );

            $this->session->set_userdata($data);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Logovanje restorana.
     * 
     * Proverava da li restoran sa datim imenom i sifrom
     * postoji, i ako postoji puni podatke o sesiji i vraca
     * poruku o uspehu, u suprotnom o neuspehu.
     * 
     * @param string $kime Korisnicko ime
     * @param string $lozinka Korisnicka lozinka
     * @return boolean Informacija o uspehu logovanja
     */
    public function loginRestoran($kime, $lozinka) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init(); //dohvatanje iskaza
        $stmt->prepare("SELECT * FROM restoran WHERE KIme = ? AND Lozinka = ?"); //pravljenje istog
        $stmt->bind_param("ss", $kime, $lozinka); //vezivanej parametara 
        $stmt->execute();

        $res = $stmt->get_result()->fetch_assoc();
        if (isset($res['IDRestoran'])) {
            $data = array(
                'userid' => $res['IDRestoran'],
                'username' => $kime,
                'loggedIn' => true,
                'restoran' => true,
                'konobar' => false,
                'korisnik' => false,
                'admin' => false
            );

            $this->session->set_userdata($data);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Logovanje konobara.
     * 
     * Proverava da li konobar sa datim imenom i sifrom
     * postoji, i ako postoji puni podatke o sesiji i vraca
     * poruku o uspehu, u suprotnom o neuspehu.
     * 
     * @param string $kime Korisnicko ime
     * @param string $lozinka Korisnicka lozinka
     * @return boolean Informacija o uspehu logovanja
     */
    public function loginKonobar($kime, $lozinka) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init(); //dohvatanje iskaza
        $stmt->prepare("SELECT * FROM konobar WHERE KIme = ? AND Lozinka = ?"); //pravljenje istog
        $stmt->bind_param("ss", $kime, $lozinka); //vezivanej parametara 
        $stmt->execute();

        $res = $stmt->get_result()->fetch_assoc();
        if (isset($res['IDKonobar'])) {
            $data = array(
                'userid' => $res['IDKonobar'],
                'username' => $kime,
                'loggedIn' => true,
                'konobar' => true,
                'korisnik' => false,
                'restoran' => false,
                'admin' => false
            );

            $this->session->set_userdata($data);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Logovanje administratora.
     * 
     * Proverava da li administrator sa datim imenom i sifrom
     * postoji, i ako postoji puni podatke o sesiji i vraca
     * poruku o uspehu, u suprotnom o neuspehu.
     * 
     * @param string $kime Korisnicko ime
     * @param string $lozinka Korisnicka lozinka
     * @return boolean Informacija o uspehu logovanja
     */
    public function loginAdmin($kime, $lozinka) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $stmt->prepare("SELECT * FROM admin WHERE KIme = ? AND Lozinka = ?");
        $stmt->bind_param("ss", $kime, $lozinka);
        $stmt->execute();

        $res = $stmt->get_result()->fetch_assoc();
        if (isset($res['IDAdmin'])) {
            $data = array(
                'userid' => $res['IDAdmin'],
                'username' => $kime,
                'loggedIn' => true,
                'admin' => true,
                'konobar' => false,
                'korisnik' => false,
                'restoran' => false
            );

            $this->session->set_userdata($data);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Proverava da li je moguce loginovanje bilo kog tipa korisnika
     * 
     * Metoda poziva sve metode vezane za proveru loginovanja odredjee vrste korisnika
     * 
     * 
     * @param string $kime korisniko ime
     * @param string $lozinka korisnicka lozinka
     * @return boolean uspesnos mogucnosti logovanja
     */
    public function login($kime, $lozinka) {


        if ($this->loginKorisnik($kime, $lozinka) || $this->loginKonobar($kime, $lozinka) || $this->loginRestoran($kime, $lozinka) || $this->loginAdmin($kime, $lozinka)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Proverava da li je registracija restorana moguca
     * 
     * Metoda prihvata sve parametre vezane za registraciju restorana i proverava ih
     * shodno pravilima sistema. Ukoliko  sve provere prodju kreira se restoran sa odredjenom galerijom slika,
     * i stolovima.(sto i slike su naglaseni jer oni nisu samo polja u restoranu vec i posebne tabele u bazi)
     * 
     * @param array $res asocijativni niz koji sadrzi sve podatke unete preko forme za registraciju restorana
     * @return boolean uspesnost registracije restorana
     */
    public function validateCreateRestoran($res) {
        $conn = $this->my_database->conn;
        $conn->autocommit(FALSE);
        $ok = true;

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->load->database();
        $this->form_validation->set_rules('kime', 'korisnicko ime', 'is_unique[Korisnik.KIme]|is_unique[Restoran.KIme]|is_unique[Konobar.KIme]|is_unique[Admin.KIme]|min_length[4]|max_length[49]|trim|required');

        $this->form_validation->set_rules('kod', 'kod za registraciju konobara', 'is_unique[Restoran.KodKonobara]|trim|required|min_length[3]|max_length[10]');
        $this->form_validation->set_rules('lozinka', 'lozinka', 'trim|required|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('iobj', 'ime objekta', 'required|trim|min_length[3]|max_length[49]');
        $this->form_validation->set_rules('ivlasnika', 'ime vlasnika', 'required|trim|min_length[3]|max_length[49]');
        $this->form_validation->set_rules('pvlasnika', 'prezime vlasnika', 'required|trim|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|trim|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('kuhinje', 'kuhinje', 'required|trim|min_length[4]|max_length[999]');
        $this->form_validation->set_rules('opis', 'opis restorana', 'required|trim|min_length[4]|max_length[2999]');

        if ($this->form_validation->run() == FALSE) {
            return false;
        } else {
            $stmt = $conn->stmt_init();
            $stmt->prepare("INSERT INTO restoran(KIme,Lozinka,ImeObjekta,
                            ImeVlasnika,PrezimeVlasnika,Email,Opis,Kuhinja,Opstina,KodKonobara)VALUES(?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param("sssssssssi", $res['kime'], $res['lozinka'], $res['iobj'], $res['ivlasnika'], $res['pvlasnika'], $res['email'], $res['opis'], $res['kuhinje'], $res['opstina'], $res['kod']);
            $stmt->execute() ? null : $ok = false;
            $restoranId = $stmt->insert_id;

            if (is_numeric($res['sto2'])) {
                for ($i = 1; $i <= $res['sto2']; $i++) {
                    $this->createSto(2, $restoranId) ? null : $ok = false;
                }
            }
            if (is_numeric($res['sto4'])) {
                for ($i = 1; $i <= $res['sto4']; $i++) {
                    $this->createSto(4, $restoranId) ? null : $ok = false;
                }
            }
            if (is_numeric($res['sto6'])) {
                for ($i = 1; $i <= $res['sto6']; $i++) {
                    $this->createSto(6, $restoranId) ? null : $ok = false;
                }
            }
           if(!( $this->uploadSlika($restoranId) == true)) $ok = false;

            if ($ok == false) {
                $conn->rollback();
                 $conn->autocommit(TRUE);
                return false;

            } else {
                $conn->commit();
            }

            $conn->autocommit(TRUE);
            return true;
        }
    }

    /**
     * Vrsi cuvanje napravljenih izmena na profilu restorana
     * 
     * Metoda prima sve parametre vezane za izmenu profila restorana
     * i vrsi provere nad njima shodno pravilima sistema. Ukoliko sve
     * provere prodju, pamte se promene u bazi. Ukoliko ne prodju, izmene
     * nece biti upamcene i vraca se poruka o neuspehu.
     * 
     * @param array $restoran asocijativni niz koji sadrzi sve podatke o restoranu koji su uneti u formu
     * @param integer $id ID restorana
     * @return boolean Uspeh/neuspeh
     */
    public function updateRestaurant($restoran, $id) {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->load->database();

        $this->form_validation->set_rules('lozinka', 'lozinka', 'trim|required|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('iobj', 'ime objekta', 'required|trim|min_length[3]|max_length[49]');
        $this->form_validation->set_rules('ivlasnika', 'ime vlasnika', 'required|trim|min_length[3]|max_length[49]');
        $this->form_validation->set_rules('pvlasnika', 'prezime vlasnika', 'required|trim|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email|trim|min_length[4]|max_length[49]');
       
        $this->form_validation->set_rules('kuhinje', 'kuhinje', 'required|trim|min_length[4]|max_length[999]');
        $this->form_validation->set_rules('opis', 'opis restorana', 'required|trim|min_length[4]|max_length[2999]');

        if ($this->form_validation->run() == FALSE) {
            return false;
        } else {
            $conn = $this->my_database->conn;
            $stmt = $conn->stmt_init();
            $stmt->prepare("UPDATE restoran SET Lozinka=?,ImeObjekta=?,ImeVlasnika=?,PrezimeVlasnika=?,Email=?,Opis=?,Kuhinja=?,Opstina=? WHERE IDRestoran=?");
            $stmt->bind_param("ssssssssi", $restoran['lozinka'], $restoran['iobj'], $restoran['ivlasnika'], $restoran['pvlasnika'], $restoran['email'], $restoran['opis'], $restoran['kuhinje'], $restoran['opstina'], $id);
            $stmt->execute();
            $restoranId = $stmt->insert_id;

            if (is_numeric($restoran['sto2'])) {
                $this->TableForTwo($restoran, $id);
            }
            if (is_numeric($restoran['sto4'])) {
                $this->TableForFour($restoran, $id);
            }
            if (is_numeric($restoran['sto6'])) {
                $this->TableForSix($restoran, $id);
            }
            return true;
        }
    }

    /**
     * Pravi nove stolove za dvoje, ili brise stare, prilikom update-a
     * profila restorana
     * 
     * Metoda prima asocijativni niz svih podataka o restoranu 
     * cija se izmena vrsi i, na osnovu novog broja stolova koji je
     * za tu kolicinu ljudi, dodaju se novi stolovi u bazu, ili se
     * brise razlika prethodnih i novih.
     * 
     * @param array $restoran asocijativni niz podataka o restoranu
     * @param integer $id ID restorana
     */
    public function TableForTwo($restoran, $id) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $param['broj'] = 2;
        $stmt->prepare("SELECT * FROM sto WHERE IDRestoranFK=? AND BrojOsoba=?");
        $stmt->bind_param("ii", $id, $param['broj']);
        $stmt->execute();
        $result = $stmt->get_result()->num_rows;
        if ($result > $restoran['sto2']) {
            for ($i = 1; $i <= ($result - $restoran['sto2']); $i++) {
                $this->deleteSto(2, $id);
            }
        } else if ($result < $restoran['sto2']) {
            for ($i = 1; $i <= ($restoran['sto2'] - $result); $i++) {
                $this->createSto(2, $id);
            }
        }
    }

    /**
     * Dodaje nove stolove za cetvoro, ili brise stare, prilikom
     * update-a profila restorana
     * 
     * Metoda prima asocijativni niz svih podataka o restoranu 
     * cija se izmena vrsi i, na osnovu novog broja stolova koji je
     * za tu kolicinu ljudi, dodaju se novi stolovi u bazu, ili se
     * brise razlika prethodnih i novih.
     * 
     * @param array $restoran asocijativni niz podataka o restoranu
     * @param integer $id ID restorana
     */
    public function TableForFour($restoran, $id) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $param['broj'] = 4;
        $stmt->prepare("SELECT * FROM sto WHERE IDRestoranFK=? AND BrojOsoba=?");
        $stmt->bind_param("ii", $id, $param['broj']);
        $stmt->execute();
        $result = $stmt->get_result()->num_rows;
        if ($result > $restoran['sto4']) {
            for ($i = 1; $i <= ($result - $restoran['sto4']); $i++) {
                $this->deleteSto(4, $id);
            }
        } else if ($result < $restoran['sto4']) {
            for ($i = 1; $i <= ($restoran['sto4'] - $result); $i++) {
                $this->createSto(4, $id);
            }
        }
    }

    /**
     * Dodaje nove stolove za sestoro, ili brise stare, prilikom
     * update-a profila restorana
     * 
     * Metoda prima asocijativni niz svih podataka o restoranu 
     * cija se izmena vrsi i, na osnovu novog broja stolova koji je
     * za tu kolicinu ljudi, dodaju se novi stolovi u bazu, ili se
     * brise razlika prethodnih i novih.
     * 
     * @param array $restoran asocijativni niz podataka o restoranu
     * @param integer $id ID restorana
     */
    public function TableForSix($restoran, $id) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $param['broj'] = 6;
        $stmt->prepare("SELECT * FROM sto WHERE IDRestoranFK=? AND BrojOsoba=?");
        $stmt->bind_param("ii", $id, $param['broj']);
        $stmt->execute();
        $result = $stmt->get_result()->num_rows;
        if ($result > $restoran['sto6']) {
            for ($i = 1; $i <= ($result - $restoran['sto6']); $i++) {
                $this->deleteSto(6, $id);
            }
        } else if ($result < $restoran['sto6']) {
            for ($i = 1; $i <= ($restoran['sto6'] - $result); $i++) {
                $this->createSto(6, $id);
            }
        }
    }

    /**
     * Funkcija koja kreira sto za odredjeni restoran
     * 
     * Funkcija koja vrsi insertovanje u bazu 
     * Kreira novu tabelu sto za oredjeni restoran
     * 
     * @param Integer $brojOsoba tip stola koji se kreira, koliko ljudi moze da sedne za isti
     * @param Integer $restoranId  id restorana kome sto pripada
     */
    public function createSto($brojOsoba, $restoranId) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $stmt->prepare("INSERT INTO sto(IDRestoranFK,BrojOsoba)VALUES(?,?)");
        $stmt->bind_param("ii", $restoranId, $brojOsoba);
        return $stmt->execute();
    }

    /**
     * Funkcija koja brise sto za odredjeni restoran
     * 
     * Metoda prima broj osoba i id restorana, na osnovu kojih
     * povezuje koji sto u bazi treba da izbrise. Vrsi brisanje reda
     * iz baze. 
     * 
     * @param integer $brojOsoba koliko ljudi moze da sedne za sto
     * @param integer $id ID restorana kome taj sto pripada
     */
    public function deleteSto($brojOsoba, $id) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $stmt->prepare("DELETE FROM sto WHERE IDRestoranFK=? AND BrojOsoba=? LIMIT 1");
        $stmt->bind_param("ii", $id, $brojOsoba);
        $stmt->execute();
    }

    /**
     * Proverava da li je registracija korisnika moguca.
     * 
     * Metoda proverava sve parametre vezane za registraciju korisnika i 
     * proverava ih u skladu sa pravilima sistema. Ukoliko su provere prosle
     * uspesno kreira se novi korisnik.
     * 
     * @param array $kor Asocijativni niz koji sadrzi sve podatke
     * unete preko forme za registraciju korisnika
     * @return boolean Informacija o uspehu ili neuspehu registracije
     */
    public function validateCreateKorisnik($kor) {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->load->database();
        $this->form_validation->set_rules('username', 'korisnicko ime', 'is_unique[Korisnik.KIme]|is_unique[Restoran.KIme]|is_unique[Konobar.KIme]|is_unique[Admin.KIme]|trim|required|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('password', 'lozinka', 'trim|required|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('name', 'ime vlasnika', 'trim|required|min_length[3]|max_length[49]');
        $this->form_validation->set_rules('lastname', 'prezime vlasnika', 'trim|required|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[4]|max_length[49]|valid_email');

        if ($this->form_validation->run() == FALSE) {
            return false;
        } else {
            $conn = $this->my_database->conn;
            $stmt = $conn->stmt_init();
            $stmt->prepare("INSERT INTO korisnik(KIme,Lozinka,Ime,Prezime,Email)VALUES(?,?,?,?,?)");
            $stmt->bind_param("sssss", $kor['username'], $kor['password'], $kor['name'], $kor['lastname'], $kor['email']);
            $stmt->execute();
            return true;
        }
    }

    /**
     * Vrsi cuvanje napravljenih izmena na profilu korisnika
     * 
     * Metoda prima sve parametre vezane za izmenu profila korisnika
     * i vrsi provere nad njima shodno pravilima sistema. Ukoliko sve
     * provere prodju, pamte se promene u bazi. Ukoliko ne prodju, izmene
     * nece biti upamcene i vraca se poruka o neuspehu.
     * 
     * @param array $korisnik asocijativni niz podataka o korisniku koji se prosledjuju kroz formu
     * @param integer $id ID korisnika
     * @return boolean Uspeh/neuspeh
     */
    public function updateUser($korisnik, $id) {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->load->database();
        $this->form_validation->set_rules('password', 'lozinka', 'trim|required|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('name', 'ime vlasnika', 'trim|required|min_length[3]|max_length[49]');
        $this->form_validation->set_rules('lastname', 'prezime vlasnika', 'trim|required|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[4]|max_length[49]|valid_email');

        if ($this->form_validation->run() == FALSE) {
            return false;
        } else {
            $conn = $this->my_database->conn;
            $stmt = $conn->stmt_init();
            $stmt->prepare("UPDATE korisnik SET Lozinka=?,Ime=?,Prezime=?,Email=? WHERE IDKorisnik=?");
            $stmt->bind_param("ssssi", $korisnik['password'], $korisnik['name'], $korisnik['lastname'], $korisnik['email'], $id);
            $stmt->execute();
            return true;
        }
    }

    /**
     * Proverava da li je registracija konobara moguca.
     * 
     * Metoda prihvata sve parametre vezane za registraciju admina i proverava ih 
     * u skladu sa pravilima sistema. Ukoliko sve provere prodju uspesno, 
     * kreira se novi konobar.
     * 
     * @param array $konobar Asocijativni niz koji sadrzi sve podatke
     * unete preko forme za registraciju konobara
     * @return boolean Informacija o uspehu ili neuspehu registracije
     */
    public function validateCreateKonobar($konobar) {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->load->database();
        $this->form_validation->set_rules('username', 'korisnicko ime', 'is_unique[Korisnik.KIme]|is_unique[Restoran.KIme]|is_unique[Konobar.KIme]|is_unique[Admin.KIme]|min_length[4]|max_length[49]|trim|required');
        $this->form_validation->set_rules('password', 'lozinka', 'trim|required|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('name', 'ime vlasnika', 'trim|required|min_length[3]|max_length[49]');
        $this->form_validation->set_rules('lastname', 'prezime vlasnika', 'trim|required|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[4]|max_length[49]|valid_email');
        $this->form_validation->set_rules('kod', 'kod konobara', 'required|trim|min_length[3]|max_length[10]');


        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $stmt->prepare("SELECT IDRestoran FROM restoran WHERE KodKonobara = ?");
        $konobar['kod'] +=0;
        $stmt->bind_param("i", $konobar['kod']);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_array();




        if ($this->form_validation->run() == FALSE || $result == null) {
            return false;
        } else {
            $konobar['IDRestoranFK'] = $result['IDRestoran'] + 0;
            $conn = $this->my_database->conn;
            $stmt = $conn->stmt_init();
            $stmt->prepare("INSERT INTO konobar(KIme,Lozinka,Ime,Prezime,Email,IDRestoranFK)VALUES(?,?,?,?,?,?)");
            $stmt->bind_param("sssssi", $konobar['username'], $konobar['password'], $konobar['name'], $konobar['lastname'], $konobar['email'], $konobar['IDRestoranFK']);
            $stmt->execute();
            return true;
        }
    }

    /**
     * Vrsi cuvanje napravljenih izmena na profilu konobara
     * 
     * Metoda prima sve parametre vezane za izmenu profila konobara
     * i vrsi provere nad njima shodno pravilima sistema. Ukoliko sve
     * provere prodju, pamte se promene u bazi. Ukoliko ne prodju, izmene
     * nece biti upamcene i vraca se poruka o neuspehu.
     * 
     * @param array $konobar asocijativni niz podataka o konobaru koji se prosledjuju iz forme
     * @param integer $id ID konobar
     * @return boolean Uspeh/neuspeh
     */
    public function updateWaiter($konobar, $id) {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->load->database();
        $this->form_validation->set_rules('password', 'lozinka', 'trim|required|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('name', 'ime vlasnika', 'trim|required|min_length[3]|max_length[49]');
        $this->form_validation->set_rules('lastname', 'prezime vlasnika', 'trim|required|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[4]|max_length[49]|valid_email');

        if ($this->form_validation->run() == FALSE) {
            return false;
        } else {
            $conn = $this->my_database->conn;
            $stmt = $conn->stmt_init();
            $stmt->prepare("UPDATE konobar SET Lozinka=?,Ime=?,Prezime=?,Email=? WHERE IDKonobar=?");
            $stmt->bind_param("ssssi", $konobar['password'], $konobar['name'], $konobar['lastname'], $konobar['email'], $id);
            $stmt->execute();
            return true;
        }
    }

    /**
     * Proverava da li je registracija admina moguca.
     * 
     * Metoda prihvata sve parametre vezane za registraciju admina i proverava ih 
     * u skladu sa pravilima sistema. Ukoliko sve provere prodju uspesno kreira se novi admin.
     *
     * @param array $admin Asocijativni niz koji sadrzi sve podatke 
     * unete preko forme za registraciju admina
     * @return boolean Informacija o uspehu ili neuspehu registracije
     */
    public function validateCreateAdmin($admin) {

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->load->database();

        $this->form_validation->set_rules('username', 'korisnicko ime', 'is_unique[Korisnik.KIme]|is_unique[Restoran.KIme]|is_unique[Konobar.KIme]|is_unique[Admin.KIme]|trim|required|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('password', 'lozinka', 'trim|required|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('name', 'ime admina', 'trim|required|min_length[3]|max_length[49]');
        $this->form_validation->set_rules('lastname', 'prezime admina', 'trim|required|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[4]|max_length[49]|valid_email');
        $this->form_validation->set_rules('code', 'kod za admina', 'required|trim|min_length[3]|max_length[10]');

        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $stmt->prepare("SELECT IDAdmin FROM admin WHERE KodAdmina = ?");
        $admin['kod'] +=0;
        $stmt->bind_param("i", $admin['kod']);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_array();

        if ($this->form_validation->run() == FALSE || $result == NULL) {
            return false;
        } else {
            $conn = $this->my_database->conn;
            $stmt = $conn->stmt_init();
            $stmt->prepare("INSERT INTO admin(KIme,Lozinka,Ime,Prezime,Email,KodAdmina)VALUES(?,?,?,?,?,?)");
            $stmt->bind_param("sssssi", $admin['username'], $admin['password'], $admin['ime'], $admin['prezime'], $admin['email'], $admin['kod']);
            $stmt->execute();
            return true;
        }
    }

    /**
     * Vrsi cuvanje napravljenih izmena na profilu admina
     * 
     * Metoda prima sve parametre vezane za izmenu profila admina
     * i vrsi provere nad njima shodno pravilima sistema. Ukoliko sve
     * provere prodju, pamte se promene u bazi. Ukoliko ne prodju, izmene
     * nece biti upamcene i vraca se poruka o neuspehu.
     * 
     * @param array $admin asocijativni niz podataka o adminu koji se prosledjuju kroz formu
     * @param integer $id ID admin
     * @return boolean Uspeh/neuspeh
     */
    public function updateAdmin($admin, $id) {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->load->database();
        $this->form_validation->set_rules('password', 'lozinka', 'trim|required|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('name', 'ime admina', 'trim|required|min_length[3]|max_length[49]');
        $this->form_validation->set_rules('lastname', 'prezime admina', 'trim|required|min_length[4]|max_length[49]');
        $this->form_validation->set_rules('email', 'email', 'trim|required|min_length[4]|max_length[49]|valid_email');

        if ($this->form_validation->run() == FALSE) {
            return false;
        } else {
            $conn = $this->my_database->conn;
            $stmt = $conn->stmt_init();
            $stmt->prepare("UPDATE admin SET Lozinka=?,Ime=?,Prezime=?,Email=? WHERE IDAdmin=?");
            $stmt->bind_param("ssssi", $admin['password'], $admin['ime'], $admin['prezime'], $admin['email'], $id);
            $stmt->execute();
            return true;
        }
    }

    public function uploadSlika($id) {
        $target_dir = "./slike/" . $id . "/";
        mkdir($target_dir);

        $total = count($_FILES['slike']['name']);

        for ($i = 0; $i < $total; $i++) {

            $target_file = $target_dir . basename($_FILES["slike"]["name"][$i]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["slike"]["tmp_name"][$i]);
                if ($check !== false) {

                    $uploadOk = 1;
                } else {
                    return "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check if file already exists
            if (file_exists($target_file)) {
                return "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES["slike"]["size"][$i] > 500000) {
                return "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                return "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["slike"]["tmp_name"][$i], $target_file)) {

                    $this->insertSlika($id, $target_file);
                } else {
                    return "Sorry, there was an error uploading your file.";
                }
            }
        }
        return true;
    }

    public function insertSlika($id, $target) {

        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $stmt->prepare("INSERT INTO slika(IDRestoranFK, Putanja) VALUES(?,?)");
        $stmt->bind_param("is", $id, $target);
        $stmt->execute();
    }

}
