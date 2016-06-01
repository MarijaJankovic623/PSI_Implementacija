<?php

/* 
 * BrisanjeKorisnika Controller
 * @author Jovana Djunisijevic
 */
class BrisanjeKorisnikaCtrl extends CI_Controller{
    
    public function index(){
        
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSessionAdmin();
       
        $this->load->model('BusinessLogic');

        $data['korisnici'] = $this->BusinessLogic->getAllUsers();
        $this->load->view('BrisanjeKorisnika1View', $data);
    }
    
    public function delete($idUser){
        $this->load->model('BusinessLogic');
        if ($this->BusinessLogic->deleteUser($idUser)) {
            $data['poruka'] = 'Korisnik je uspesno uklonjen sa sistema';
        } else {
            $data['poruka'] = 'Korisnik nije uspesno uklonjen sa sistema';
        }
        $data['korisnici'] = $this->BusinessLogic->getAllUsers();
        $this->load->view('BrisanjeKorisnika3View', $data);
    }
    
    public function check($idUser){
        $id['id']=$idUser;
        $this->load->view('BrisanjeKorisnika2View', $id);
    }
    
    public function pogled(){
        $this->load->view('ProfilAdminaView');
    }
}
