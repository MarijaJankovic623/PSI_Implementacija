<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Home
 *
 * @author Marko
 */
class Home extends CI_Controller {

    public function index() {
        $this->load->model("BusinessLogic");

        $data['restorani'] = $this->BusinessLogic->getAllRestaurants();

        $this->load->view('17-Pogled gosta na sistem', $data);
    }

    public function test() {

        $em = $this->doctrine->em;
        $sql = "CALL slobodni_stolovi(:idres, :brlj, :vremeod, :vremedo)";
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->bindValue('idres', 29);
        $stmt->bindValue('brlj', 2);
        $stmt->bindValue('vremeod', '2010-05-06 10:10:00');
        $stmt->bindValue('vremedo', '2010-05-06 13:11:00');
        $stmt->execute();

        $result = $stmt->fetchAll();

        var_dump($result);
        $em->flush();
    }

}
