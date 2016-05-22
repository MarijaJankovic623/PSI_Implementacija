<?php
/**
 * Description of RegistracijaKorisnikaCtrl
 *
 * @author Marko
 */
class RegistracijaKorisnikaCtrl extends CI_Controller {

    public function index() {

        $this->load->view('RegistracijaKorisnikaView');
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
            $this->load->view('LoginView');
        } else {
            $this->load->view('RegistracijaKorisnikaView');
        }
    }

}
