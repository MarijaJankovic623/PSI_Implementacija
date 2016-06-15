<?php

class Login_test extends TestCase {
    /*
     * poziva se jednom za svaku test metodu 
     */

    public function setUp() {
        $this->resetInstance();
        $this->CI->load->library("my_database");

        $conn = $this->CI->my_database->conn;
        $conn->autocommit(FALSE);
        $ok = true;

        $conn->query("INSERT INTO korisnik(KIme,Lozinka)VALUES('KorisnikTest','lozinkaTest');") ? null : $ok = false;
        $conn->query("INSERT INTO restoran(IDRestoran,KIme,Lozinka)VALUES(999,'RestoranTest','lozinkaTest');") ? null : $ok = false;
        $conn->query("INSERT INTO konobar(KIme,Lozinka,IDRestoranFK)VALUES('KonobarTest','lozinkaTest',999);") ? null : $ok = false;
        $conn->query("INSERT INTO admin(KIme,Lozinka)VALUES('AdminTest','lozinkaTest');") ? null : $ok = false;

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
     */
    public function tearDown() {
        $conn = $this->CI->my_database->conn;
       
        $conn->query("DELETE FROM korisnik WHERE KIme='KorisnikTest';");
        $conn->query("DELETE FROM konobar WHERE KIme='KonobarTest';");
        $conn->query("DELETE FROM restoran WHERE KIme='RestoranTest';");
        $conn->query("DELETE FROM admin WHERE KIme='AdminTest';");
    }

    public function testLoginKorisnik() {
        $this->CI->load->model('UserValidationModel');
        $rez = $this->CI->UserValidationModel->login('KorisnikTest', 'lozinkaTest');
        $this->assertEquals(true, $rez, "Doslo je do greske pri logovanju korisnika.");
    }

    public function testLoginRestoran() {
        $this->CI->load->model('UserValidationModel');
        $rez = $this->CI->UserValidationModel->login('RestoranTest', 'lozinkaTest');
        $this->assertEquals(true, $rez, "Doslo je do greske pri logovanju restorana.");
    }

    public function testLoginKonobar() {
        $this->CI->load->model('UserValidationModel');
        $rez = $this->CI->UserValidationModel->login('KonobarTest', 'lozinkaTest');
        $this->assertEquals(true, $rez, "Doslo je do greske pri logovanju konobara.");
    }

    public function testLoginAdmin() {
        $this->CI->load->model('UserValidationModel');
        $rez = $this->CI->UserValidationModel->login('AdminTest', 'lozinkaTest');
        $this->assertEquals(true, $rez, "Doslo je do greske pri logovanju admina.");
    }

}
