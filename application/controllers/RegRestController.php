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
       
      $kime = $this->input->post('kime');
      $lozinka = $this->input->post('lozinka');
      $imeobjekta = $this->input->post('iobj');
      $imevlasnika = $this->input->post('ivlasnika');
      $prezimevlasnika = $this->input->post('pvlasnika');
      $email = $this->input->post('email');

      
      $restoran = new Restoran();
      
      $restoran->setKime($kime);
      $restoran->setLozinka($lozinka);
      $restoran->setImeobjekta($imeobjekta);
      $restoran->setImevlasnika($imevlasnika);
      $restoran->setPrezimevlasnika($prezimevlasnika);
      $restoran->setEmail($email);
      

$this->load->library('form_validation');

$this->form_validation->set_error_delimiters('<div class="error">', '</div>');


$this->form_validation->set_rules('kime', 'kime', 'is_unique[Restoran.KIme]|trim|required');

$this->form_validation->set_rules('lozinka', 'lozinka', 'trim|required|min_length[4]|max_length[32]');

$this->form_validation->set_rules('iobj', 'imeobjekta', 'required|min_length[5]|max_length[15]');

$this->form_validation->set_rules('ivlasnika', 'imevlasnika', 'required|min_length[5]|max_length[15]');

$this->form_validation->set_rules('pvlasnika', 'prezimevlasnika', 'required|min_length[5]|max_length[15]');

$this->form_validation->set_rules('email', 'email', 'required|valid_email');

if ($this->form_validation->run() == FALSE)
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
