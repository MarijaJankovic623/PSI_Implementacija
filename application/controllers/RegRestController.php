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
class RegRestController extends CI_Controller {

    public function index() {

        $this->load->view('02-Registracija restorana');
    }

    public function submit() {

        $this->load->model("UserValidationModel");


        if ($this->UserValidationModel->read_validate_make_Restaurant()) {
            $this->load->view('05-Logovanje');
        } else {
            $this->load->view('02-Registracija restorana');
        }
    }

}
