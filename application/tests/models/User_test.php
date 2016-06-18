<?php

class User_test extends TestCase {
    /**
     * metoda se poziva pre svakog testa
     */
    public function setUp() {
        $this->resetInstance();
        $this->CI->load->library("my_database");
        
        $conn=$this->CI->my_database->conn;
        $conn->autocommit(FALSE);
        $ok=true;
        
        $conn->query("INSERT INTO korisnik(IDKorisnik)VALUES(2000);") ? null : $ok=false;
        $conn->query("INSERT INTO korisnik(IDKorisnik)VALUES(2001);") ? null : $ok=false;
        $conn->query("INSERT INTO admin(IDAdmin)VALUES(2000);") ? null : $ok=false;
        
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
     * metoda se zove nakon svakog izvrsenog testa
     */
    public function tearDown() {
        $conn=$this->CI->my_database->conn;
        
        $conn->query("DELETE FROM admin WHERE IDAdmin=2000;");
        $conn->query("DELETE FROM korisnik WHERE IDKorisnik=2001;");
        $conn->query("DELETE FROM korisnik WHERE IDKorisnik=2000;");
    }
    /**
     * metoda vrsi proveru uspesnog brisanja korisnika
     */
    public function testDeleteUserSuccessfully() {
        $this->CI->load->model('BusinessLogic');
        $res=$this->CI->BusinessLogic->deleteUser(2001);
        $this->assertEquals(true, $res, "Doslo je do greske prilikom brisanja korisnika");
    }
    /**
     * metoda vrsi proveru uspesnog dohvatanja svih korisnika
     */
    public function testGetAllUsers() {
        $this->CI->load->model('BusinessLogic');
        $res=$this->CI->BusinessLogic->getAllUsers();
        $res=array_reverse($res);
       // var_dump($res);
        $this->assertEquals(2001, $res[0]['IDKorisnik'], "Doslo je do greske u dohvatanju korisnika");
        $this->assertEquals(2000, $res[1]['IDKorisnik'], "Doslo je do greske u dohvatanju korisnika");
    }
}
