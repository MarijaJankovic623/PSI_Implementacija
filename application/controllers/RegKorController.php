<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegKorController
 *
 * @author Marko
 */
class RegKorController extends CI_Controller{
    
    public function index(){
        $this->load->helper('url');
        $this->load->view('01-Registracija korisnika');
        
    }
    
    public function submit(){
        
        $this->load->model('entities/korisnik');
        
        $kor = new Korisnik();
        $in = $this->input;
        
        $kor->setIme($in->post('name'));
        $kor->setPrezime($in->post('lastname'));
        $kor->setKime($in->post('username'));
        $kor->setLozinka($in->post('password'));
        $kor->setEmail($in->post('email'));
        
        $em = $this->doctrine->em;
        $em->persist($kor);
        $em->flush();
        
        $this->load->helper('url');
        $this->load->view('01-Registracija korisnika');
        
    }

    
    
}
