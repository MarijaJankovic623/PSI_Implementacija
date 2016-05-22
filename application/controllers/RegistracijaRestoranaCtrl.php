<?php
/**
 * Description of RegistracijaRestoranaCtrl
 *
 * @author Marija
 */
class RegistracijaRestoranaCtrl extends CI_Controller {

    public function index() {
        $this->load->view('RegistracijaRestoranaView');
    }

    public function submit() {
        $this->load->model("UserValidationModel");

        $input = $this->input;
        $restoran = array(
            "kime" => $input->post('kime'),
            "lozinka" => $input->post('lozinka'),
            "iobj" => $input->post('iobj'),
            "ivlasnika" => $input->post('ivlasnika'),
            "pvlasnika" => $input->post('pvlasnika'),
            "email" => $input->post('email'),
            "sto2" => $input->post('sto_2'),
            "sto4" => $input->post('sto_4'),
            "sto6" => $input->post('sto_6'),
        );

        if ($this->UserValidationModel->validateCreateRestoran($restoran)) {
            $this->load->view('LoginView');
        } else {
            $this->load->view('RegistracijaRestoranaView');
        }
    }

}
