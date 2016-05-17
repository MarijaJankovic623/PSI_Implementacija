<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginController
 *
 * @author Marko
 */
class LoginController extends CI_Controller {

    public function index() {

        $this->load->view('05-Logovanje');
    }

    public function submit() {
        $this->load->model('UserValidationModel');

        if ($this->UserValidationModel->login()) {

            redirect('PreResController/index');
        } else {
            $this->load->view('05-Logovanje');
        }
    }

}
