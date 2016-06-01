<?php

/* 
 * Potvrda Izvrsene Rezervacije Controller
 * 
 * @author Jovana 
 */

class PotvrdaIzvrseneRezervacijeCtrl extends CI_Controller{
    
    public function index(){
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSessionKonobar();
       
        $this->load->model('BusinessLogic');
        $data['rezervacije']=$this->BusinessLogic->getReservations();
        $data['restoran']=$this->BusinessLogic->getNameRestaurant();
        $this->load->view('PotvrdaIzvrseneRezervacijeView', $data);
    }
   
    public function potvrdi($rez){
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSessionKonobar();
       
        $this->load->model('BusinessLogic');
        if($this->BusinessLogic->oslobodi($rez)){
            $data['poruka']="Uspesno oslobodjen sto!";
        }
        else{
            $data['poruka']="Neuspesno oslobodjen sto!";
        }
        
        $data['potvrda']=true;
        $data['rezervacije']=$this->BusinessLogic->getReservations();
        $data['restoran']=$this->BusinessLogic->getNameRestaurant();
        $this->load->view('PotvrdaIzvrseneRezervacijeView', $data);
    }
    
}