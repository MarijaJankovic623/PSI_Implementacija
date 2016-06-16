<?php

class FreeTables_test extends TestCase{
    /**
     * setUp je metoda koja se poziva pre svakog testa
     */
    public function setUp() {
        $this->resetInstance();
        $this->CI->load->library("my_database");
        
        $conn=$this->CI->my_database->conn;
        $conn->autocommit(FALSE);
        $ok=true;
        
        $conn->query("INSERT INTO korisnik(IDKorisnik,KIme)VALUES(2000,'TestKorisnik');") ? null : $ok=false;
        $conn->query("INSERT INTO restoran(IDRestoran,ImeObjekta)VALUES(2000,'VoyATravesarLaPlanetaEntera');") ? null : $ok=false;
        $conn->query("INSERT INTO konobar(IDKonobar,IDRestoranFK,KIme,Lozinka)VALUES(2000,2000,'konobarIX','konobarIX');") ? null : $ok=false;
        $conn->query("INSERT INTO sto(IDSto,IDRestoranFK,BrojOsoba)VALUES(2000,2000,4);") ? null : $ok=false;
        $conn->query("INSERT INTO rezervacija(IDRezervacija,IDStoFK,IDKorisnikFK,VremeOd,VremeDo)VALUES(2000,2000,2000,'2016-06-28 15:00','2016-06-28 17:00');") ? null : $ok=false;
        $conn->query("INSERT INTO rezervacija(IDRezervacija,IDStoFK,IDKorisnikFK,VremeOd,VremeDo)VALUES(2001,2000,2000,'2016-06-29 15:30','2016-06-29 17:30');") ? null : $ok=false;
        
        if ($ok == false) {
            $conn->rollback();
            print('********Pokusajte ponovo,doslo je do konflikta sa test podacima********');
            $this->markTestSkipped('Testovi preskoceni, zao mi je');
        }
        else {
            $conn->commit();
        }
        
        $conn->autocommit(TRUE);
    }
    /**
     * metoda se poziva posle svakog testa
     */
    public function tearDown() {
        $conn=$this->CI->my_database->conn;
        
        $conn->query("DELETE FROM rezervacija WHERE IDRezervacija=2001;");
        $conn->query("DELETE FROM rezervacija WHERE IDRezervacija=2000;");
        $conn->query("DELETE FROM sto WHERE IDSto=2000;");
        $conn->query("DELETE FROM konobar WHERE IDKonobar=2000;");
        $conn->query("DELETE FROM restoran WHERE IDRestoran=2000;");
        $conn->query("DELETE FROM korisnik WHERE IDKorisnik=2000;");
    } 
    /**
     * metoda testira da li se uspesno pravi nova rezervacija od strane konobara
     */
    public function testFreeTablesNew() {
        $this->CI->load->model('BusinessLogic');
       
        $korisnik=array(
            "imeKorisnika" => 'TestKorisnik'
        );
        $res=$this->CI->BusinessLogic->freeTables(2000,4,'2016-07-20 15:00','2016-07-20 17:00',$korisnik);
        $conn=$this->CI->my_database->conn;
        $conn->query("DELETE FROM rezervacija WHERE IDKorisnikFK=2000;");
        $this->assertEquals(true, $res, "Doslo je do greske prilikom rezervacije");
       
    }
    /**
     * metoda testira da li se sprecava pravljenje nove rezervacije
     * od strane konobara, ako takva vec postoji
     */
    public function testFreeTablesExisting() {
        $this->CI->load->model('BusinessLogic');
        $korisnik=array(
            "imeKorisnika" => "TestKorisnik"
        );
        $res=$this->CI->BusinessLogic->freeTables(2000,4,'2016-06-28 15:30','2016-06-28 17:00', $korisnik);
        
        $this->assertEquals(false, $res, "Doslo je greske prilikom prosledjivanja parametara");
    }
    /**
     * metoda testira uspesno oslobadjanje stola od strane konobara
     */
    public function testOslobodi() {
        $this->CI->load->model('BusinessLogic');
        $rezervacija=array(
            "IDRezervacija" => 2000,
            "IDStoFK" => 2000,
            "IDKorisnikFK" => 2000,
            "VremeOd" => '2016-10-10 15:00',
            "VremeDo" => '2016-10-10 17:00'
        );
        $res=$this->CI->BusinessLogic->oslobodi($rezervacija);
        $this->assertEquals(true, $res, "Doslo je do greske prilikom oslobadjanja stola");
    }
    
    /**
     * metoda testira uspesno dohvatanje imena restorana u kome radi ulogovani konobar
     */
    public function testGetNameRestaurant() {
        $this->CI->load->model('BusinessLogic');
        $this->CI->load->model('UserValidationModel');
        $this->CI->UserValidationModel->login('konobarIX','konobarIX');
        
        $res=$this->CI->BusinessLogic->getNameRestaurant();
        $this->assertEquals('VoyATravesarLaPlanetaEntera', $res, "Doslo je do greske pri dohvatanju imena restorana");
    }
    /**
     * metoda testira uspesno dohvatanje svih rezervacija nekog restorana,
     * na osnovu konobara koji u tom restoranu radi
     */
    public function testGetReservations() {
        $this->CI->load->model('BusinessLogic');
        $this->CI->load->model('UserValidationModel');
        $this->CI->UserValidationModel->login('konobarIX','konobarIX');
        
        $res=$this->CI->BusinessLogic->getReservations();
        
        $this->assertEquals(2000, $res[0]['IDRezervacija'], "Doslo je do greske prilikom dohvatanja rezervacija");
        $this->assertEquals(2001, $res[1]['IDRezervacija'], "Doslo je do greske prilikom dohvatanja rezervacija");
    }
}
