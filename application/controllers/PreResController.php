<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PreResController
 *
 * @author Marko
 */
class PreResController extends CI_Controller {

    public function index() {
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSession();

        $this->load->model('BusinessLogic');

        $data['restorani'] = $this->BusinessLogic->getAllRestaurants();

        $this->load->view('08-Prelistavanje restorana', $data);
    }

}
