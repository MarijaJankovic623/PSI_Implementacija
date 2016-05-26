<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EditovanjeNalogaCtrl
 * 
 * @author Ivana
 */

class EditovanjeNalogaCtrl extends CI_Controller {
    public function index() {
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSession();
        $this->load->model('BusinessLogic');
        $data['user']=$this->BusinessLogic->getUser($this->session->userdata('userid'));
        
        $this->load->view('EditNalogaKorisnikView', $data);
    }
}