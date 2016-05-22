<?php

/**
 * Description of RezervisanjeStolaCtrl
 *
 * @author Marko
 */
class RezervisanjeStolaCtrl extends CI_Controller {

    public function rezervisi($idRestorana) {
        $brLjudi = $this->input->post('brLjudi');
        $vremeOd = $this->input->post('vremeOd');
        $vremeDo = $this->input->post('vremeDo');


        $this->load->model('BusinessLogic');
        if ($this->BusinessLogic->reserveTable($idRestorana, $brLjudi, $vremeOd, $vremeDo)) {
            $data['poruka'] = 'Uspesno ste rezervisali sto';
        } else {
            $data['poruka'] = 'Nije moguce obaviti datu rezervaciju';
        }
        $data['rezervisanje'] = true;
        $data['restorani'] = $this->BusinessLogic->getAllRestaurants();

        $this->load->view('PrelistavanjeRestoranaView', $data);
    }

}
