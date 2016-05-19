<?php
/**
 * Description of RegKorController
 *
 * @author Marko
 */
class RegKorController extends CI_Controller {

    public function index() {

        $this->load->view('01-Registracija korisnika');
    }

    public function submit() {
        $this->load->model('UserValidationModel');
      
        $input = $this->input;
        $korisnik = array(
            "name" => $input->post('name'),
            "lastname" => $input->post('lastname'),
            "username" => $input->post('username'),
            "password" => $input->post('password'),
            "email" => $input->post('email')
        );



        if ($this->UserValidationModel->validateCreateKorisnik($korisnik)) {
            $this->load->view('05-Logovanje');
        } else {
            $this->load->view('01-Registracija korisnika');
        }
    }

}
