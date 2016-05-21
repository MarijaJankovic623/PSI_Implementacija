<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegKonController
 *
 * @author Marija
 */
class RegKonController extends CI_Controller {
    public function index() {

        $this->load->view('03-Registracija konobara');
    }

    public function submit() {

        $this->load->model('UserValidationModel');

        $input = $this->input;
        $konobar = array(
            "name" => $input->post('name'),
            "lastname" => $input->post('lastname'),
            "username" => $input->post('username'),
            "password" => $input->post('password'),
            "email" => $input->post('email'),
            "kod"=>$input->post('kod')
        );



        if ($this->UserValidationModel->validateCreateKonobar($konobar)) {
            $this->load->view('05-Logovanje');
        } else {
            $this->load->view('03-Registracija konobara');
        }
    }
}
