<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registrationModel
 *
 * @author Marija
 */
class UserValidationModel extends CI_Model {

    public function checkSession() {
        $is_logged_in = $this->session->userdata('is_logged_in');

        if (!isset($is_logged_in) || $is_logged_in != true) {
            redirect('home/index');
        }
    }

    public function login() {


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
            return true;
            //redirect('PreResController/index');
        } else {
            //$this->load->view('05-Logovanje');
            return false;
        }
    }

    public function read_validate_make_Restaurant() {


        $this->load->model("entities/restoran");

        $korisnicko_ime = $this->input->post('kime');
        $lozinka = $this->input->post('lozinka');
        $ime_objekta = $this->input->post('iobj');
        $ime_vlasnika = $this->input->post('ivlasnika');
        $prezime_vlasnika = $this->input->post('pvlasnika');
        $email = $this->input->post('email');


        $sto2 = $this->input->post('sto_2');
        $sto4 = $this->input->post('sto_4');
        $sto6 = $this->input->post('sto_6');

        $restoran = new Restoran();

        $restoran->setKime($korisnicko_ime);
        $restoran->setLozinka($lozinka);
        $restoran->setImeobjekta($ime_objekta);
        $restoran->setImevlasnika($ime_vlasnika);
        $restoran->setPrezimevlasnika($prezime_vlasnika);
        $restoran->setEmail($email);

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->load->database();
        $this->form_validation->set_rules('kime', 'korisnicko ime', 'is_unique[Restoran.KIme]|trim|required');
        /*
          $this->form_validation->set_rules('lozinka', 'lozinka', 'trim|required|min_length[4]|max_length[32]');
          $this->form_validation->set_rules('iobj', 'ime objekta', 'required');
          $this->form_validation->set_rules('ivlasnika', 'ime vlasnika', 'required|max_length[15]');
          $this->form_validation->set_rules('pvlasnika', 'prezime vlasnika', 'required|max_length[15]');
          $this->form_validation->set_rules('email', 'email', 'required|valid_email');
         */
        if ($this->form_validation->run() == FALSE) {
            return false;
        } else {

            $em = $this->doctrine->em;
            $em->persist($restoran);
            $em->flush();

            if (is_numeric($sto2)) {
                for ($i = 1; $i <= $sto2; $i++) {
                    $this->read_validate_make_Sto(2, $restoran);
                }
            }
            if (is_numeric($sto4)) {
                for ($i = 1; $i <= $sto4; $i++) {
                    $this->read_validate_make_Sto(4, $restoran);
                }
            }
            if (is_numeric($sto6)) {
                for ($i = 1; $i <= $sto6; $i++) {
                    $this->read_validate_make_Sto(6, $restoran);
                }
            }
            return true;
        }
    }

    public function read_validate_make_Sto($brojosoba, $idrestoranfk) {

        $this->load->model("entities/sto");

        $sto = new Sto();

        $sto->setBrojosoba($brojosoba);
        $sto->setIdrestoranfk($idrestoranfk);

        $em = $this->doctrine->em;
        $em->persist($sto);
        $em->flush();
    }

    public function read_validate_make_Korisnik() {

        $this->load->model('entities/korisnik');

        $in = $this->input;
        $kor = new Korisnik();
        $kor->setIme($in->post('name'));
        $kor->setPrezime($in->post('lastname'));
        $kor->setKime($in->post('username'));
        $kor->setLozinka($in->post('password'));
        $kor->setEmail($in->post('email'));



        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $this->load->database();
        $this->form_validation->set_rules('username', 'korisnicko ime', 'is_unique[Restoran.KIme]|trim|required');
        $this->form_validation->set_rules('password', 'lozinka', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('name', 'ime vlasnika', 'required|max_length[15]');
        $this->form_validation->set_rules('lastname', 'prezime vlasnika', 'required|max_length[15]');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');



        if ($this->form_validation->run() == FALSE) {
            return false;
        } else {
            $em = $this->doctrine->em;
            $em->persist($kor);
            $em->flush();
            return true;
        }
    }

}
