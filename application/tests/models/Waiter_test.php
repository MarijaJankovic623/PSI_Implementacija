<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Waiter_test extends TestCase{
    
     public function setUp() {

            $this->resetInstance();
            $this->CI->load->library("my_database");
            $conn = $this->CI->my_database->conn;
            $conn->autocommit(FALSE);
            $ok = true;



            $conn->query("INSERT INTO restoran(IDRestoran,KIme,Lozinka,ImeObjekta,ImeVlasnika,PrezimeVlasnika,KodKonobara)VALUES(3998,'RestoranJovanaTest','LozinkaTest','ObjekatTest','VlasnikTest','VlasnikTest','9998');") ? null : $ok = false;
            $conn->query("INSERT INTO sto(IDSto,IDRestoranFK,BrojOsoba)VALUES(2998,3998,2);") ? null : $ok = false;
            $conn->query("INSERT INTO sto(IDSto,IDRestoranFK,BrojOsoba)VALUES(2997,3998,4);") ? null : $ok=false;
            $conn->query("INSERT INTO sto(IDSto,IDRestoranFK,BrojOsoba)VALUES(2995,3998,4);") ? null : $ok=false;
            $conn->query("INSERT INTO sto(IDSto,IDRestoranFK,BrojOsoba)VALUES(2996,3998,6);") ? null : $ok=false;
            $conn->query("INSERT INTO konobar(IDKonobar,KIme,Lozinka,Ime,Prezime,IDRestoranFK)VALUES(4998,'KonobarJovanaTest','LozinkaTest','ImeTest','PrezimeTest',3998);")? null : $ok=false;
            $conn->query("INSERT INTO konobar(IDKonobar,KIme,Lozinka,Ime,Prezime,IDRestoranFK)VALUES(4997,'KonobarJovanaTest2','LozinkaTest2','ImeTest2','PrezimeTest2',3998);")? null : $ok=false;
            

            if ($ok == false) {
                $conn->rollback();

                print('********Pokusajte ponovo,doslo je do konflikta sa test podacima********');
                $this->markTestSkipped('Nema da moze bree');
            } else {
                $conn->commit();
            }

            $conn->autocommit(TRUE);
        }
        
        public function tearDown() {

        $conn = $this->CI->my_database->conn;
        
        $conn->query("DELETE FROM konobar WHERE IDKonobar=4998 ;");
        $conn->query("DELETE FROM konobar WHERE IDKonobar=4997 ;");
        $conn->query("DELETE FROM sto WHERE IDSto= 2995 ;");
        $conn->query("DELETE FROM sto WHERE IDSto= 2996 ;");
        $conn->query("DELETE FROM sto WHERE IDSto= 2997 ;");
        $conn->query("DELETE FROM sto WHERE IDSto = 2998 ;");
        $conn->query("DELETE FROM restoran WHERE IDRestoran = 3998 ;");
    }
    
    /**
     * Ovaj test dohvata sve konobare za odredjeni restoran.
     * U funkciji getAllWaiters se prenese ID restorana.
     */
    public function testGetAllWaiters(){
        $this->CI->load->model('BusinessLogic');
        $rez=$this->CI->BusinessLogic->getAllWaiters(3998);
        $this->assertEquals(4997,$rez[0]['IDKonobar'], "Doslo je do greske pri dohvatanju konobara.");
        $this->assertEquals(4998,$rez[1]['IDKonobar'], "Doslo je do greske pri dohvatanju konobara.");
    }
    
    /**
     * Ovaj test proverava da li ce se konobar uspesno ukloniti iz 
     * baze i sistema. Treba da vrati vrednost true.
     */
    public function testDeleteWaiter(){
        $this->CI->load->model('BusinessLogic');
        $rez=$this->CI->BusinessLogic->deleteWaiter(4997);
        $this->assertEquals(true, $rez, "Doslo je do greske pri brisanju konobara.");
    }
    
    /**
     * Ovaj test proverava da li se uspesno dohvata konobar sa
     * odredjenim ID-em.
     */
    public function testGetUser(){
        $this->CI->load->model('BusinessLogic');
        $this->CI->load->model('UserValidationModel');
        $rez = $this->CI->UserValidationModel->login('KonobarJovanaTest', 'LozinkaTest');
        $rez=$this->CI->BusinessLogic->getUser(4998);
        $this->assertEquals('KonobarJovanaTest',$rez['KIme'],"Doslo je do greske pri dohvatanju korisnika.");
    }
    
}
