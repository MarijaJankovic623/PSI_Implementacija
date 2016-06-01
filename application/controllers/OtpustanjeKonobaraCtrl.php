<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of OtpustanjeKonobaraCtrl
 * 
 * @author Ivana
 */
class OtpustanjeKonobaraCtrl extends CI_Controller {
    public function index($id) {
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSessionRestoran();
        
        $this->load->model('BusinessLogic');
        $data['konobari']=$this->BusinessLogic->getAllWaiters($id);
        
        $this->load->view('OtpustanjeKonobaraView', $data);
    }
    
    public function AreYouSure($id) {
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSessionRestoran();
        $noviID['id']=$id;
        $this->load->view('OtpustiKonobaraAreYouSureView', $noviID);
    }
    
    public function delete($id) {
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSessionRestoran();
        $this->load->model('BusinessLogic');
        if ($this->BusinessLogic->deleteWaiter($id)==true) {
            $data['poruka']='Konobar je uspesno izbrisan';
        }
        else {
            $data['poruka']='Konobar nije uspesno izbrisan';
        }
        $data['otpustanje'] = true;
        $ID=$this->session->userdata('userid');
        $data['konobari']=$this->BusinessLogic->getAllWaiters($ID);
        $this->load->view('OtpustanjeKonobaraView', $data);
    }
    
    public function profil($id) {
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSessionRestoran();
        
        $this->load->model('BusinessLogic');
        $data['rest']=$this->BusinessLogic->getRestaurant($id);
        $this->load->view('ProfilRestoranaView', $data);
    }
}