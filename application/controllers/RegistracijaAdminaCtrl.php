<?php

/* 
 * RegistracijaAdmina Controller
 * 
 *  @author Jovana Djunisijevic
 */

class RegistracijaAdminaCtrl extends CI_Controller{
    
    public function index(){
        
        $this->load->view('RegistracijaAdminaView');
    }
    
    public function submit(){
        
        $this->load->model('UserValidationModel');
        $input=$this->input;
        $admin=array(
            "username"=>$input->post('username'),
            "password"=>$input->post('password'),
            "ime"=>$input->post('name'),
            "prezime"=>$input->post('lastname'),
            "email"=>$input->post('email'),
            "kod"=>$input->post('code')
        
        );
        
        if ($this->UserValidationModel->validateCreateAdmin($admin)){
            $this->load->view('LoginView'); 
        }
        else {
            $this->load->view('RegistracijaAdminaView');
        }
    }
}