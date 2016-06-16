<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Restaurant_test extends TestCase{
    
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
     * Ovaj test poziva funkciju za dohvatanje broja stolova
     * za odredjeni broj ljudi u odredjenom restoranu.
     * 
     */
    public function testGetNumberOfTables(){
        $this->CI->load->model('BusinessLogic');
        $rez=$this->CI->BusinessLogic->getNumberOfTables(3998,4);
        $this->assertEquals(2,$rez,"Doslo je do greske pri dohvatanju broja stolova.");
    }
    
    /**
     * Ovaj test proverava da li ce uspesno da se dohvati odredjeni korisnik.
     */
    public function testGetUser(){
        $this->CI->load->model('BusinessLogic');
        $this->CI->load->model('UserValidationModel');
        $rez = $this->CI->UserValidationModel->login('RestoranJovanaTest', 'LozinkaTest');
        $rez=$this->CI->BusinessLogic->getUser(3998);
        $this->assertEquals('RestoranJovanaTest',$rez['KIme'],"Doslo je do greske pri dohvatanju korisnika.");
    }
    
    /**
     * Ovaj test proverava da li ce uspesno da se ukloni sto iz 
     * restorana, prenosimo ID restorana i broj ljudi za koji je taj 
     * sto namenjen. Proverava se baza prvo, gde se dohvataju svi stolovi
     * za taj odredjeni broj ljudi, pa se proverava da li je broj sada manji.
     */
    public function testDeleteSto(){
        $this->CI->load->model('UserValidationModel');
        $this->CI->UserValidationModel->deleteSto(4,3998);
        $this->CI->load->model('BusinessLogic');
        $rez=$this->CI->BusinessLogic->getNumberOfTables(3998,4);
        $this->assertEquals(1,$rez,"Doslo je do greske pri dohvatanju broju stolova.");
    }
}