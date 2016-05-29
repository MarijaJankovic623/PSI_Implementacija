<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeCtrl
 *
 * @author Marko
 */
class HomeCtrl extends CI_Controller {

    public function index() {
        $this->load->model("BusinessLogic");

        $data['restorani'] = $this->BusinessLogic->getAllRestaurants();

        $this->load->view('HomeView', $data);
    }
    
    public function criteriaRestaurants(){
        $brLjudi = $this->input->post('brLjudi');
        $vremeOd = $this->input->post('vremeOd');
        $vremeDo = $this->input->post('vremeDo');
        $opstina = $this->input->post('opstina');
        
        $this->load->model("BusinessLogic");

        $data['restorani'] = $this->BusinessLogic->getCriteriaRestaurants($opstina,$brLjudi,$vremeOd,$vremeDo);

        $this->load->view('HomeView', $data);
          
    }

}
