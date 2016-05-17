<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of business_logic
 *
 * @author Marija
 */
class BusinessLogic extends CI_Model {

    //put your code here

    public function getAllRestaurants() {

        $this->load->model("entities/restoran");

        $em = $this->doctrine->em;
        $qb = $em->createQueryBuilder();

        $qb->select('r')
                ->from('restoran', 'r');

        return $qb->getQuery()->getResult();
    }

}
