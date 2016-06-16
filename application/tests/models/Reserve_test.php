<?php

class Reserve_test extends TestCase {
    /*
     * poziva se jednom pre svake test metode
     */

    public function setUp() {
// Load CI instance normally
        $this->resetInstance();
        $this->CI->load->library("my_database");
        $conn = $this->CI->my_database->conn;
        $conn->autocommit(FALSE);
        $ok = true;



        $conn->query("INSERT INTO korisnik(IDKorisnik,KIme)VALUES(997,'KorisnikTest');") ? null : $ok = false;
        $conn->query("INSERT INTO Restoran(IDRestoran,KIme,Lozinka,ImeObjekta,ImeVlasnika,PrezimeVlasnika,Email,Opis,Kuhinja,Opstina,KodKonobara)VALUES(997,'RestoranTest3','1234','RestoranTest','VlasnikTest','VlasnikTest','test@gmail.com','Testiran restoran','Testirajuca kuhinja','Novi Beograd','9997');") ? null : $ok = false;
        $conn->query("INSERT INTO sto(IDSto,IDRestoranFK,BrojOsoba)VALUES(997,997,2);") ? null : $ok = false;
        $conn->query("INSERT INTO rezervacija(IDRezervacija,IDStoFK,IDKorisnikFK,VremeOd, VremeDo)VALUES(997,997,997,'2016-06-28 12:00', '2016-06-28 14:00');") ? null : $ok = false;
        



        if ($ok == false) {
            $conn->rollback();

            print('********Pokusajte ponovo,doslo je do konflikta sa test podacima********');
            $this->markTestSkipped('Nema da moze bree');
        } else {
            $conn->commit();
        }

        $conn->autocommit(TRUE);
    }

    /**
     * tear down se zove cak i ako je test skipovan
     * i poziva se jednom pre svakog testa
     */
    public function tearDown() {

        $conn = $this->CI->my_database->conn;

        $conn->query("DELETE FROM rezervacija WHERE IDRezervacija = 997;");
        $conn->query("DELETE FROM sto WHERE IDSto = 997;");
        $conn->query("DELETE FROM Restoran WHERE IDRestoran = 997 ;");
        $conn->query("DELETE FROM korisnik WHERE IDKorisnik = 997");
    }

    /**
     * Ova metoda testira da li je moguca rezervacija ukoliko su svi prosledjeni parametri validni 
     * i ne postoji ni jedna druga rezervacija
     * za odredjeni restoran i odredjeni sto koja bi onemogucila nasu rezervaciju
     */
    public function testGoodReservation() {

        $this->CI->load->model('BusinessLogic');
        $rez = $this->CI->BusinessLogic->reserveTable(997, 2, '2016-09-01 12:00', '2016-09-01 14:00');
        $this->assertTrue($rez, "Doslo je do greske pri rezervaciji restorana sa dobrim parametrima");
    }
    
    /**
     * Metoda testira da li moze da se izvrsi rezervacija ukoliko postoji 
     * rezervacija za oredjeni restoran za odredjeni sto a da je postojeca rezervacija 
     * vremenski obuhvata u potpunosti
     * 
     */
    public function testVecPostojiRezervacija1(){
        
        $this->CI->load->model('BusinessLogic');
        $rez = $this->CI->BusinessLogic->reserveTable(997, 2, '2016-06-28 13:00', '2016-06-28 13:50');
        $this->assertFalse($rez, "Doslo je do greske pri rezervaciji restorana sa dobrim parametrima");
        
    }
    
      /**
     * Metoda testira da li moze da se izvrsi rezervacija ukoliko postoji 
     * rezervacija za oredjeni restoran za odredjeni sto a da se postojeca rezervacija 
     * vremenski poklapa sa krajem zelene nove rezervacije
     * zeljena_rez<postojece_rez
     */
    public function testVecPostojiRezervacija2(){
        
        $this->CI->load->model('BusinessLogic');
        $rez = $this->CI->BusinessLogic->reserveTable(997, 2, '2016-06-28 11:00', '2016-06-28 13:00');
        $this->assertFalse($rez, "Doslo je do greske pri rezervaciji restorana sa dobrim parametrima");
        
    }
      
     /**
     * Metoda testira da li moze da se izvrsi rezervacija ukoliko postoji 
     * rezervacija za oredjeni restoran za odredjeni sto a da se postojeca rezervacija 
     * vremenski poklapa sa pocetkom zelene nove rezervacije
     * postojeca_rezervacija<zeljena_rezervacija
     */
    public function testVecPostojiRezervacija3(){
        
        $this->CI->load->model('BusinessLogic');
        $rez = $this->CI->BusinessLogic->reserveTable(997, 2, '2016-06-28 13:00', '2016-06-28 15:00');
        $this->assertFalse($rez, "Doslo je do greske pri rezervaciji restorana sa dobrim parametrima");
        
    }
      
            
            
 /**
  * testira da li je moguca rezervacija ukoliko se pokusa rezervisanje za datume koji su pre danasnjeg
  * 
  */
    public function testBadVremeProslo() {

        $this->CI->load->model('BusinessLogic');
        $rez = $this->CI->BusinessLogic->reserveTable(997, 2, '2016-05-01 12:00', '2016-05-01 14:00');
        $this->assertFalse($rez, "Doslo je do greske pri rezervaciji restorana sa dobrim parametrima");
    }

    
    /**
     * testira da li je moguca rezervacija ukoliko se pokusa rezervisanje sa datumom prijave 
     * koji je nakon datuma odjave
     */
    public function testBadVremePocetakPosleKrajaSearch() {

        $this->CI->load->model('BusinessLogic');
        $rez = $this->CI->BusinessLogic->reserveTable(997, 2, '2016-10-01 12:00', '2016-09-01 14:00');
        $this->assertFalse($rez, "Doslo je do greske pri rezervaciji restorana sa dobrim parametrima");
    }

}
