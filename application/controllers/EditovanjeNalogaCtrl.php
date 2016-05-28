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
    
    public function profileUser() {
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSession();
        $this->load->model('BusinessLogic');
        $data['user']=$this->BusinessLogic->getUser($this->session->userdata('userid'));
        $this->load->view('ProfilKorisnikaView', $data);
    }

    public function profileWaiter() {
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSession();
        $this->load->model('BusinessLogic');
        $data['user']=$this->BusinessLogic->getUser($this->session->userdata('userid'));
        $this->load->view('ProfilKonobaraView', $data);
    }
    
    public function profileAdmin() {
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSession();
        $this->load->model('BusinessLogic');
        $data['user']=$this->BusinessLogic->getUser($this->session->userdata('userid'));
        $this->load->view('ProfilAdminaView', $data);
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
        else if ($this->session->userdata('restoran')) {
            $input = $this->input;
            $restoran = array(
                "lozinka" => $input->post('lozinka'),
                "iobj" => $input->post('iobj'),
                "ivlasnika" => $input->post('ivlasnika'),
                "pvlasnika" => $input->post('pvlasnika'),
                "email" => $input->post('email'),
                "opis" =>$input->post('opis'),
                "kuhinje" => $input->post('kuhinje'),
                "opstina" =>$input->post('opstina'),
                "kod" => $input->post('kod'),
                "sto2" => $input->post('sto_2'),
                "sto4" => $input->post('sto_4'),
                "sto6" => $input->post('sto_6'),
            );
            $id=$this->session->userdata('userid');
            if ($this->UserValidationModel->updateRestaurant($restoran, $id)) {
                redirect('OtpustanjeKonobaraCtrl/profil/'.$id);
            }
            else {
                $this->load->model('BusinessLogic');
                $data['user']=$this->BusinessLogic->getUser($this->session->userdata('userid'));
                $this->load->view('EditNalogaRestoranView', $data);
            }
        }
        else if ($this->session->userdata('konobar')) {
            $input = $this->input;
            $konobar = array(
                "name" => $input->post('name'),
                "lastname" => $input->post('lastname'),
                "password" => $input->post('password'),
                "email" => $input->post('email')
            );
            $this->load->model('BusinessLogic');
            $id=$this->session->userdata('userid');
            if ($this->UserValidationModel->updateWaiter($konobar, $id)) {
                $data['user']=$this->BusinessLogic->getUser($this->session->userdata('userid'));
                $this->load->view('ProfilKonobaraView', $data);
            }
            else {
                $this->load->view('EditNalogaKonobarView', $data);
            }
        }
        else if ($this->session->userdata('admin')) {
            $input=$this->input;
            $admin=array(
                "password"=>$input->post('password'),
                "ime"=>$input->post('name'),
                "prezime"=>$input->post('lastname'),
                "email"=>$input->post('email')
            );
            $this->load->model('BusinessLogic');
            $id=$this->session->userdata('userid');
            if ($this->UserValidationModel->updateAdmin($admin, $id)) {
                $data['user']=$this->BusinessLogic->getUser($this->session->userdata('userid'));
                $this->load->view('ProfilAdminaView', $data);
            }
            else {
                $this->load->view('EditNalogaAdminView', $data);
            }
        }
    }
}