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
    
    public function index(){
        $this->load->model("businessLogic");
     
        $data['restorani'] = $this->businessLogic->getAllRestaurants();
        
        $this->load->view('17-Pogled gosta na sistem',$data);
        
    }
    
    public function test(){
        
        $em = $this->doctrine->em;
        $qb = $em->createNativeQuery(
        'CALL slobodni_stolovi (' .
            ':idres, :brlj, :vremeod, :vremedo' .
        ')',
        new \Doctrine\ORM\Query\ResultSetMapping()
        );
        $qb->setParameters(
        array(
            'idres' => 1,
            'brlj' => 4,
            'vremeod' => '2010-05-06 10:10:00',
            'vremedo' => '2010-05-06 13:11:00',
        ));
        
        $qb->execute();
        $p = $qb->fetchAll();
        foreach ( $p as $t)
            echo $t;
        
        $em->flush();
    }
    
}
