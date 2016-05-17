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
        $this->load->model('entities/korisnik');

        $em = $this->doctrine->em;
        $qb = $em->createQueryBuilder();

        $qb->select('k')
                ->from('korisnik', 'k')
                ->where('k.kime = :user')
                ->andWhere('k.lozinka = :pass')
                ->setParameter('user', $this->input->post('username'))
                ->setParameter('pass', $this->input->post('password'));


        if ($qb->getQuery()->getResult()) {
            $data = array(
                'username' => $this->input->post('username'),
                'is_logged_in' => true
            );

            $this->session->set_userdata($data);
            redirect('PreResController/index');
        } else {
            $this->load->view('05-Logovanje');
        }
    }

}
