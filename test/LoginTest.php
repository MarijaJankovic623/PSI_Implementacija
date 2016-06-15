<?php

class LoginTest extends PHPUnit_Framework_TestCase {

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

        $conn->query("INSERT INTO korisnik(KIme,Lozinka)VALUES('KorisnikTest','lozinkaTest');") ? null : $ok = false;
        $conn->query("INSERT INTO restoran(IDRestoran,KIme,Lozinka)VALUES(999,'RestoranTest','lozinkaTest');") ? null : $ok = false;
        $conn->query("INSERT INTO konobar(KIme,Lozinka,IDRestoranFK)VALUES('KonobarTest','lozinkaTest',999);") ? null : $ok = false;
        $conn->query("INSERT INTO admin(KIme,Lozinka)VALUES('AdminTest','lozinkaTest');") ? null : $ok = false;

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
            $conn->query("DELETE FROM korisnik WHERE KIme='KorisnikTest';");
            $conn->query("DELETE FROM konobar WHERE KIme='KonobarTest';");
            $conn->query("DELETE FROM restoran WHERE KIme='RestoranTest';");
            $conn->query("DELETE FROM admin WHERE KIme='AdminTest';");
        }
    }

    public function testLoginKorisnik() {
        self::$CI->load->model('UserValidationModel');
        $rez = self::$CI->UserValidationModel->login('KorisnikTest', 'lozinkaTest');
        $this->assertEquals(true, $rez, "Doslo je do greske pri logovanju korisnika.");
    }

    public function testLoginRestoran() {
        self::$CI->load->model('UserValidationModel');
        $rez = self::$CI->UserValidationModel->login('RestoranTest', 'lozinkaTest');
        $this->assertEquals(true, $rez, "Doslo je do greske pri logovanju restorana.");
    }

    public function testLoginKonobar() {
        self::$CI->load->model('UserValidationModel');
        $rez = self::$CI->UserValidationModel->login('KonobarTest', 'lozinkaTest');
        $this->assertEquals(true, $rez, "Doslo je do greske pri logovanju konobara.");
    }

    public function testLoginAdmin() {
        self::$CI->load->model('UserValidationModel');
        $rez = self::$CI->UserValidationModel->login('AdminTest', 'lozinkaTest');
        $this->assertEquals(true, $rez, "Doslo je do greske pri logovanju admina.");
    }

}
