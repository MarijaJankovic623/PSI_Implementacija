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
        
        if ($this->session->userdata('korisnik')) {
            $this->load->view('EditNalogaKorisnikView', $data);
        }
        else if ($this->session->userdata('restoran')) {
            $this->load->view('EditNalogaRestoranView', $data);
        }
        else if ($this->session->userdata('konobar')) {
            $this->load->view('EditNalogaKonobarView', $data);
        }
        else if ($this->session->userdata('admin')) {
            $this->load->view('EditNalogaAdminView', $data);
        }
    }
    
    public function confirm() {
        $this->load->model('UserValidationModel');
        if ($this->session->userdata('korisnik')) {
            $input = $this->input;
            $korisnik = array(
                "name" => $input->post('name'),
                "lastname" => $input->post('lastname'),
                "password" => $input->post('password'),
                "email" => $input->post('email')
            );
            $id=$this->session->userdata('userid');
            if ($this->UserValidationModel->updateUser($korisnik, $id)) {
                redirect('PrelistavanjeRestoranaCtrl/index');
            }
            else {
                $this->load->model('BusinessLogic');
                $data['user']=$this->BusinessLogic->getUser($this->session->userdata('userid'));
                $this->load->view('EditNalogaKorisnikView', $data);
            }
        }
    }
}