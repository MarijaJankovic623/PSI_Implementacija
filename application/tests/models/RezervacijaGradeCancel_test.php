<?php

class RezervacijaGradeCancelGetAll_test extends TestCase {
    /*
     * poziva se jednom za svaku test metodu 
     */

    public function setUp() {
        $this->resetInstance();
        $this->CI->load->library("my_database");

        $conn = $this->CI->my_database->conn;
        $conn->autocommit(FALSE);
        $ok = true;

        $conn->query("INSERT INTO korisnik(IDKorisnik,KIme,Lozinka)VALUES(999,'KorisnikTest','lozinkaTest');") ? null : $ok = false;
        $conn->query("INSERT INTO restoran(IDRestoran,KIme,Lozinka)VALUES(999,'RestoranTest','lozinkaTest');") ? null : $ok = false;
        $conn->query("INSERT INTO sto(IDSto,IDRestoranFK,BrojOsoba)VALUES(999,999,2)") ? null : $ok = false;
        $conn->query("INSERT INTO rezervacija(IDRezervacija,IDStoFK,IDKorisnikFK,Status) VALUES(999,999,999,'Nadolazeca')") ? null : $ok = false;
        $conn->query("INSERT INTO rezervacija(IDRezervacija,IDStoFK,IDKorisnikFK,Status) VALUES(998,999,999,'Nadolazeca')") ? null : $ok = false;

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
       
        $conn->query("DELETE FROM rezervacija WHERE IDRezervacija=998;");
        $conn->query("DELETE FROM rezervacija WHERE IDRezervacija=999;");
        $conn->query("DELETE FROM korisnik WHERE IDKorisnik=999;");
        $conn->query("DELETE FROM sto WHERE IDSto=999;");
        $conn->query("DELETE FROM restoran WHERE IDRestoran=999;");
    }

    public function testRezervacijaCancel() {
        $this->CI->load->model('BusinessLogic');
        $rezervacija = array(
            "idrezervacija" => 999
        );
        $this->CI->BusinessLogic->rezervacijaCancel($rezervacija);
        $conn = $this->CI->my_database->conn;
        $rez = $conn->query("SELECT * FROM rezervacija WHERE IDRezervacija = 999");
        $rez = $rez->fetch_assoc();

        $this->assertEquals('Otkazana', $rez['Status'], "Doslo je do greske pri brisanju rezervacije.");
    }

    public function testRezervacijaGradeOcena() {
        $this->CI->load->model('BusinessLogic');
        $rezervacija = array(
            "idrezervacija" => 999,
            "ocena" => 10
        );
        $this->CI->BusinessLogic->rezervacijaGrade($rezervacija);

        $conn = $this->CI->my_database->conn;
        $rez = $conn->query("SELECT * FROM rezervacija WHERE IDRezervacija = 999");
        $rez = $rez->fetch_assoc();

        $this->assertEquals(10, $rez['Ocena'], "Doslo je do greske pri unosenju ocene u rezervaciju.");
    }

    public function testRezervacijaGradeSrednjaOcena() {
        $this->CI->load->model('BusinessLogic');
        $rezervacija = array(
            "idrezervacija" => 999,
            "ocena" => 10
        );
        $this->CI->BusinessLogic->rezervacijaGrade($rezervacija);

        $rezervacija = array(
            "idrezervacija" => 999,
            "ocena" => 8
        );
        $this->CI->BusinessLogic->rezervacijaGrade($rezervacija);

        $conn = $this->CI->my_database->conn;
        $rez = $conn->query("SELECT * FROM restoran WHERE IDRestoran = 999");
        $rez = $rez->fetch_assoc();

        $this->assertEquals(9, $rez['Ocena'], "Doslo je do greske pri azuriranju srednje ocene restorana.");
    }

    public function testRezervacijaGetAll() {
        $this->CI->load->model('BusinessLogic');

        $rez = $this->CI->BusinessLogic->getAllReservations(999);

        $this->assertEquals(998, $rez[0]['IDRezervacija'], "Doslo je do greske pri dohvatanju rezervacije.");
        $this->assertEquals(999, $rez[1]['IDRezervacija'], "Doslo je do greske pri dohvatanju rezervacije.");
    }

}
