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

    public function checkSession() {
        $is_logged_in = $this->session->userdata('loggedIn');

        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('home/index');
        }
    }

    public function login($kime,$lozinka) {
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
                'loggedIn' => true
            );

            $this->session->set_userdata($data);
            return true;
        } else {
            return false;
        }
    }

    public function validateCreateRestoran($res) {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        /* OZBILJNE PROVERE OVDE */
        $this->load->database();
        $this->form_validation->set_rules('kime', 'korisnicko ime', 'is_unique[Restoran.KIme]|trim|required');
        /*
          $this->form_validation->set_rules('lozinka', 'lozinka', 'trim|required|min_length[4]|max_length[32]');
          $this->form_validation->set_rules('iobj', 'ime objekta', 'required');
          $this->form_validation->set_rules('ivlasnika', 'ime vlasnika', 'required|max_length[15]');
          $this->form_validation->set_rules('pvlasnika', 'prezime vlasnika', 'required|max_length[15]');
          $this->form_validation->set_rules('email', 'email', 'required|valid_email');
         */
        if ($this->form_validation->run() == FALSE) {
            return false;
        } else {
            $conn = $this->my_database->conn;
            $stmt = $conn->stmt_init();
            $stmt->prepare("INSERT INTO restoran(KIme,Lozinka,ImeObjekta,
                            ImeVlasnika,PrezimeVlasnika,Email)VALUES(?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $res['kime'], $res['lozinka'], $res['iobj'], $res['ivlasnika'], $res['pvlasnika'], $res['email']); 
            $stmt->execute();
            $restoranId = $stmt->insert_id;

            if (is_numeric($res['sto2'])) {
                for ($i = 1; $i <= $res['sto2']; $i++) {
                    $this->createSto(2, $restoranId);
                }
            }
            if (is_numeric($res['sto4'])) {
                for ($i = 1; $i <= $res['sto4']; $i++) {
                    $this->createSto(4, $restoranId);
                }
            }
            if (is_numeric($res['sto6'])) {
                for ($i = 1; $i <= $res['sto6']; $i++) {
                    $this->createSto(6, $restoranId);
                }
            }
            return true;
        }
    }

    public function createSto($brojOsoba, $restoranId) {
        $conn = $this->my_database->conn;
        $stmt = $conn->stmt_init();
        $stmt->prepare("INSERT INTO sto(IDRestoranFK,BrojOsoba)VALUES(?,?)");
        $stmt->bind_param("ii", $restoranId, $brojOsoba);
        $stmt->execute();
    }

    public function validateCreateKorisnik($kor) {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->load->database();
        $this->form_validation->set_rules('username', 'korisnicko ime', 'is_unique[Restoran.KIme]|trim|required');
        $this->form_validation->set_rules('password', 'lozinka', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('name', 'ime vlasnika', 'required|max_length[15]');
        $this->form_validation->set_rules('lastname', 'prezime vlasnika', 'required|max_length[15]');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            return false;
        } else {
            $conn = $this->my_database->conn;
            $stmt = $conn->stmt_init();
            $stmt->prepare("INSERT INTO korisnik(KIme,Lozinka,Ime,Prezime,Email)VALUES(?,?,?,?,?)");
            $stmt->bind_param("sssss",$kor['username'],$kor['password'],$kor['name'],$kor['lastname'],$kor['email']); 
            $stmt->execute();
            return true;
        }
    }

}
