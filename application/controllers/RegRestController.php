<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegRestController
 *
 * @author Marija
 */
class RegRestController extends CI_Controller{
   
   public function index(){
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->view('02-Registracija restorana');

   } 
   
   public function submit(){
       
        $this->load->helper('form');
        $this->load->model('entities/restoran'); 

        $korisnicko_ime = $this->input->post('kime');
        $lozinka = $this->input->post('lozinka');
        $ime_objekta = $this->input->post('iobj');
        $ime_vlasnika = $this->input->post('ivlasnika');
        $prezime_vlasnika = $this->input->post('pvlasnika');
        $email = $this->input->post('email');


        $restoran = new Restoran();
      
        $restoran->setKime($korisnicko_ime);
        $restoran->setLozinka($lozinka);
        $restoran->setImeobjekta($ime_objekta);
        $restoran->setImevlasnika($ime_vlasnika);
        $restoran->setPrezimevlasnika($prezime_vlasnika);
        $restoran->setEmail($email);
      

        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        $this->load->database();

        $this->form_validation->set_rules('kime', 'korisnicko ime','is_unique[Restoran.KIme]|trim|required');


        $this->form_validation->set_rules('lozinka', 'lozinka', 'trim|required|min_length[4]|max_length[32]');

        $this->form_validation->set_rules('iobj', 'ime objekta', 'required');

        $this->form_validation->set_rules('ivlasnika', 'ime vlasnika', 'required|max_length[15]');

        $this->form_validation->set_rules('pvlasnika', 'prezime vlasnika', 'required|max_length[15]');

        $this->form_validation->set_rules('email', 'email', 'required|valid_email'); 

if ($this->form_validation->run() == FALSE )
{       
       
        $this->load->helper('url');
        $this->load->view('02-Registracija restorana');

}
else
{
        $em = $this->doctrine->em;
        $em->persist($restoran);
        $em->flush();   
        $this->load->helper('url');
        $this->load->view('05-Logovanje');
}      
}

    
}
 