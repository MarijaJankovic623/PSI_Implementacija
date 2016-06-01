<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PrelistavanjeRestoranaCtrl
 *
 * @author Marko
 */
class PrelistavanjeRestoranaCtrl extends CI_Controller {

    public function index() {
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSessionKorisnik();
        $this->load->model('BusinessLogic');

        $data['restorani'] = $this->BusinessLogic->getAllRestaurants();
        $this->load->view('PrelistavanjeRestoranaView', $data);
    }

    public function restoranDetails($id) {
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSessionKorisnik();
        $this->load->model('BusinessLogic');

        $data['restoran'] = $this->BusinessLogic->getRestaurant($id);
        $this->load->view('RezervisanjeStolaView', $data);
    }

    public function criteriaRestaurants() {
        $brLjudi = $this->input->post('brLjudi');
        $vremeOd = $this->input->post('vremeOd');
        $vremeDo = $this->input->post('vremeDo');
        $opstina = $this->input->post('opstina');

        $this->load->model("BusinessLogic");

        $data['restorani'] = $this->BusinessLogic->getCriteriaRestaurants($opstina, $brLjudi, $vremeOd, $vremeDo);

        $this->load->view('PrelistavanjeRestoranaView', $data);
    }

}
