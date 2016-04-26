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
        $this->checkSession();
        $this->load->model("entities/restoran");

        $em = $this->doctrine->em;
        $qb = $em->createQueryBuilder();

        $qb->select('r')
                ->from('restoran', 'r');

        $data['restorani'] = $qb->getQuery()->getResult();

        $this->load->view('08-Prelistavanje restorana', $data);
    }

    private function checkSession() {
        $is_logged_in = $this->session->userdata('is_logged_in');

        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('home/index');
        }
    }
}  