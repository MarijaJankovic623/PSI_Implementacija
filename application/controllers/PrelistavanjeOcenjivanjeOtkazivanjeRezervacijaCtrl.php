<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PrelistavanjeOcenjivanjeOtkazivanjeRezervacijaCtrl
 *
 * @author Marija
 */
class PrelistavanjeOcenjivanjeOtkazivanjeRezervacijaCtrl  extends CI_Controller{
    
    public function index() {
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSession();
        $this->load->model('BusinessLogic');

        $data['rezervacije'] = $this->BusinessLogic->getAllReservations( $this->session->userdata('userid'));
   
        $this->load->view('PrelistavanjeOcenjivanjeOtkazivanjeRezervacijaView', $data);
    }

    public function restoranDetails($id) {
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSession();
        $this->load->model('BusinessLogic');
        
        $data['restoran'] = $this->BusinessLogic->getRestaurant($id);
        $this->load->view('RezervisanjeStolaView', $data);
    }
}
