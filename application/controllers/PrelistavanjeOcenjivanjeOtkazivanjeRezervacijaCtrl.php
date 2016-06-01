<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PrelistavanjeOcenjivanjeOtkazivanjeRezervacijaCtrl
 *
 * @author Marija
 */
class PrelistavanjeOcenjivanjeOtkazivanjeRezervacijaCtrl extends CI_Controller {

    public function index() {
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSessionKorisnik();
        $this->load->model('BusinessLogic');

        $data['rezervacije'] = $this->BusinessLogic->getAllReservations($this->session->userdata('userid'));

        $this->load->view('PrelistavanjeOcenjivanjeOtkazivanjeRezervacijaView', $data);
    }

    public function rezervacijaCancelGrade($id) {
        $this->load->model('UserValidationModel');
        $this->UserValidationModel->checkSessionKorisnik();
        $this->load->model('BusinessLogic');

        if (isset($_POST['oceniDugme'])) {

            $input = $this->input;
            $rezervacija = array(
                "idrezervacija" => $id,
                "ocena" => $input->post('ocena'),
            );

            $this->BusinessLogic->rezervacijaGrade($rezervacija);

            $data['rezervacije'] = $this->BusinessLogic->getAllReservations($this->session->userdata('userid'));

            $this->load->view('PrelistavanjeOcenjivanjeOtkazivanjeRezervacijaView', $data);
            
        } else if (isset($_POST['otkaziDugme'])) {

            $input = $this->input;
            $rezervacija = array(
                "idrezervacija" => $id,
            );

            $this->BusinessLogic->rezervacijaCancel($rezervacija);

            $data['rezervacije'] = $this->BusinessLogic->getAllReservations($this->session->userdata('userid'));

            $this->load->view('PrelistavanjeOcenjivanjeOtkazivanjeRezervacijaView', $data);
    }}
    

}
