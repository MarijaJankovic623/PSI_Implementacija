<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LogoutCtrl
 *
 * @author Marko
 */
class LogoutCtrl extends CI_Controller {

    public function index(){
        $this->session->sess_destroy();
        redirect("HomeCtrl");
        //ovo i nije bilo tesko, hehe :D
    }
    
}
