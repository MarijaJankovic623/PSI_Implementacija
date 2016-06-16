<?php

class Search_test extends TestCase {

    /**
     * Metoda koja se poziva pre poziva svake od test metoda i koja ima za cilj da inicijalizuje 
     * podatke neophodne za testiranje
     */
    public function setUp() {

        $this->resetInstance();
        $this->CI->load->library("my_database");
        $conn = $this->CI->my_database->conn;
        $conn->autocommit(FALSE);
        $ok = true;



        $conn->query("INSERT INTO Restoran(IDRestoran,KIme,Lozinka,ImeObjekta,ImeVlasnika,PrezimeVlasnika,Email,Opis,Kuhinja,Opstina,KodKonobara)VALUES(998,'RestoranTest2','1234','RestoranTest','VlasnikTest','VlasnikTest','test@gmail.com','Testiran restoran','Testirajuca kuhinja','Novi Beograd','9998');") ? null : $ok = false;
        $conn->query("INSERT INTO sto(IDSto,IDRestoranFK,BrojOsoba)VALUES(998,998,2);") ? null : $ok = false;



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


        $conn->query("DELETE FROM sto WHERE IDSto = 998 ;");
        $conn->query("DELETE FROM Restoran WHERE IDRestoran = 998 ;");
    }

    public function testGoodSearch() {

        $this->CI->load->model('BusinessLogic');
        $rez = $this->CI->BusinessLogic->getCriteriaRestaurants('Novi Beograd', 2, '2016-09-01 12:00', '2016-09-01 14:00');
        $this->assertNotNull($rez, "Doslo je do greske pri vracanju restorana sa dobrim parametrima");
    }

    public function testBadOpstinaSearch() {

        $this->CI->load->model('BusinessLogic');
        $rez = $this->CI->BusinessLogic->getCriteriaRestaurants('Zvezdara', 2, '2016-09-01 12:00', '2016-09-01 14:00');
        $restoran_za_proveru = null;

        foreach ($rez as $restoran) {
            if ($restoran['IDRestoran'] == 998) {
                $restoran_za_proveru = $restoran;
            }
        }

        $this->assertNull($restoran_za_proveru, "Doslo je do greske pri vracanju restorana sa losom opstinom");
    }

    /**
     * testira da li je moguca pretraga ukoliko se pokusa rezervisanje za datume koji su pre danasnjeg
     * odnosno da li ce biti vracen neki restoran za nevalidne podatke
     * 
     */
    public function testBadVremeProsloSearch() {

        $this->CI->load->model('BusinessLogic');
        $rez = $this->CI->BusinessLogic->getCriteriaRestaurants('Novi Beograd', 2, '2016-05-01 12:00', '2016-05-01 14:00');

        $this->assertNull($rez, "Doslo je do greske pri vracanju restorana sa losim vremenom");
    }

    /**
     * testira da li je moguca pretraga uukoliko se unese  datumom prijave 
     * koji je nakon datuma odjave

     * odnosno da li ce biti vracen neki restoran za nevalidne podatke
     * 
     */
    public function testBadVremePocetakPosleKrajaSearch() {

        $this->CI->load->model('BusinessLogic');
        $rez = $this->CI->BusinessLogic->getCriteriaRestaurants('Novi Beograd', 2, '2016-10-01 12:00', '2016-09-01 14:00');
        $this->assertNull($rez, "Doslo je do greske pri vracanju restorana sa losim vremenom");
    }

    /**
     * testira da li metoda vraca restoran za prosledjeni id
     */
    public function testDohvatanjeResPoIdSearch() {

        $this->CI->load->model('BusinessLogic');
        $rez = $this->CI->BusinessLogic->getRestaurant(998);
        $this->assertNotNull($rez, "Doslo je do greske pri vracanju restorana sa losim vremenom");
    }

    /*     * proverava da li metoda vraca restorane s obzirom da smo jedan rucno upisali
     */

    public function testDohvatanjeSvihRestoranaSearch() {

        $this->CI->load->model('BusinessLogic');
        $rez = $this->CI->BusinessLogic->getAllRestaurants();
        $this->assertNotNull($rez, "Doslo je do greske pri vracanju restorana sa losim vremenom");
    }

}
