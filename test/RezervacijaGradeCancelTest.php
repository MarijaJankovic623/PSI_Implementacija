<?php

class RezervacijaGradeCancelTest extends PHPUnit_Framework_TestCase {

    private static $CI;
    private static $result;

    /*
     * poziva se jednom za celu klasu na pocetku
     */

    public static function setUpBeforeClass() {
        // Load CI instance normally
        self::$CI = &get_instance();
        self::$result = true;

        self::$CI->load->library("my_database");

        $conn = self::$CI->my_database->conn;
        $conn->autocommit(FALSE);
        $ok = true;

        $conn->query("INSERT INTO korisnik(IDKorisnik,KIme,Lozinka)VALUES(999,'KorisnikTest','lozinkaTest');") ? null : $ok = false;
        $conn->query("INSERT INTO restoran(IDRestoran,KIme,Lozinka)VALUES(999,'RestoranTest','lozinkaTest');") ? null : $ok = false;
        $conn->query("INSERT INTO sto(IDSto,IDRestoranFK,BrojOsoba)VALUES(999,999,2)") ? null : $ok = false;
        $conn->query("INSERT INTO rezervacija(IDRezervacija,IDStoFK,IDKorisnikFK,Status) VALUES(999,999,999,'Nadolazeca')") ? null : $ok = false;
        var_dump("Usao 1");
        if ($ok == false) {
            $conn->rollback();
            self::$result = false;
            print('********Pokusajte ponovo,doslo je do konflikta sa test podacima********');
        } else {
            $conn->commit();
        }

        $conn->autocommit(TRUE);
    }

    /*
     * poziva se jednom za svaku test metodu 
     */

    public function setUp() {
        if (LoginTest::$result == false)
            $this->markTestSkipped('Nema da moze bree');
        /* ukoliko unos u bazu na samom pocetku nije prosao
         * preskacemo svaku test metodu
         */
    }

    /**
     * tear down se zove cak i ako je test skipovan
     * i poziva se jednom za celu klasu
     */
    public static function tearDownAfterClass() {
        $conn = self::$CI->my_database->conn;
        if (self::$result != false) {
            $conn->query("DELETE FROM rezervacija WHERE IDRezervacija=999;");
            $conn->query("DELETE FROM korisnik WHERE IDKorisnik=999;");
            $conn->query("DELETE FROM sto WHERE IDSto=999;");
            $conn->query("DELETE FROM restoran WHERE IDRestoran=999;");
        }
    }

    public function testRezervacijaCancel() {
        var_dump("Usao 2");
        self::$CI->load->model('BusinessLogic');
        $rez = self::$CI->BusinessLogic;
        $this->assertEquals(true, $rez, "Doslo je do greske pri logovanju korisnika.");
        var_dump("Usao 3");
    }


}
