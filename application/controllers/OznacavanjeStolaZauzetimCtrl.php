<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OznOdrStlZauzController
 *
 * @author Marija i Jovana
 */
class OznacavanjeStolaZauzetimCtrl extends CI_Controller {


    public function index() {
        
        $this->load->view('OznacavanjeStolaZauzetimView');
        
}

    public function reserve(){
        
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSessionKonobar();
        $this->load->model('BusinessLogic');
        $brLjudi = $this->input->post('brLjudi');
        $vremeOd = $this->input->post('vremeOd');
        $vremeDo = $this->input->post('vremeDo');
        $id=$this->session->userdata('userid');
        $korisnik['imeKorisnika']="gost";
        if($this->BusinessLogic->freeTables($id, $brLjudi, $vremeOd, $vremeDo, $korisnik)){
            $data['poruka']="Uspesno je rezervisan sto";
        }
        else {
            $data['poruka']="Nije moguce napraviti rezervaciju";
        }
        $data['zauzeto'] = true;
        $this->load->view('OznacavanjeStolaZauzetimView', $data);
    }
}
