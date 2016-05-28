<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginCtrl
 *
 * @author Marko
 */
class LoginCtrl extends CI_Controller {

    public function index() {
        $this->load->view('LoginView');
    }

    public function submit() {
        $this->load->model('UserValidationModel');
        $in = $this->input;
        if ($this->UserValidationModel->login($in->post('username'), $in->post('password'))) {
            if ($this->session->userdata('korisnik'))
                redirect('PrelistavanjeRestoranaCtrl/index');
            
            if ($this->session->userdata('konobar'))
                redirect('OznacavanjeStolaZauzetimCtrl/index');
            
            if ($this->session->userdata('restoran')) {
                $id=$this->session->userdata('userid');
                redirect("OtpustanjeKonobaraCtrl/profil/$id");
            }
            if ($this->session->userdata('admin')) {
                $this->load->model('BusinessLogic');
                $data['user']=$this->BusinessLogic->getUser($this->session->userdata('userid'));
                $this->load->view('ProfilAdminaView', $data);
            }
           
               
        } else {
            $this->load->view('LoginView');
        }
    }

}
