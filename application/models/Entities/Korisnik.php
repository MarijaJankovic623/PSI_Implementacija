<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Korisnik
 *
 * @Table(name="korisnik")
 * @Entity
 */
class Korisnik
{
    /**
     * @var integer
     *
     * @Column(name="IDKorisnik", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idkorisnik;

    /**
     * @var string
     *
     * @Column(name="KIme", type="string", length=50, nullable=true)
     */
    private $kime;

    /**
     * @var string
     *
     * @Column(name="Lozinka", type="string", length=50, nullable=true)
     */
    private $lozinka;

    /**
     * @var string
     *
     * @Column(name="Ime", type="string", length=50, nullable=true)
     */
    private $ime;

    /**
     * @var string
     *
     * @Column(name="Prezime", type="string", length=50, nullable=true)
     */
    private $prezime;

    /**
     * @var string
     *
     * @Column(name="Email", type="string", length=50, nullable=true)
     */
    private $email;


    /**
     * Get idkorisnik
     *
     * @return integer 
     */
    public function getIdkorisnik()
    {
        return $this->idkorisnik;
    }

    /**
     * Set kime
     *
     * @param string $kime
     * @return Korisnik
     */
    public function setKime($kime)
    {
        $this->kime = $kime;
    
        return $this;
    }

    /**
     * Get kime
     *
     * @return string 
     */
    public function getKime()
    {
        return $this->kime;
    }

    /**
     * Set lozinka
     *
     * @param string $lozinka
     * @return Korisnik
     */
    public function setLozinka($lozinka)
    {
        $this->lozinka = $lozinka;
    
        return $this;
    }

    /**
     * Get lozinka
     *
     * @return string 
     */
    public function getLozinka()
    {
        return $this->lozinka;
    }

    /**
     * Set ime
     *
     * @param string $ime
     * @return Korisnik
     */
    public function setIme($ime)
    {
        $this->ime = $ime;
    
        return $this;
    }

    /**
     * Get ime
     *
     * @return string 
     */
    public function getIme()
    {
        return $this->ime;
    }

    /**
     * Set prezime
     *
     * @param string $prezime
     * @return Korisnik
     */
    public function setPrezime($prezime)
    {
        $this->prezime = $prezime;
    
        return $this;
    }

    /**
     * Get prezime
     *
     * @return string 
     */
    public function getPrezime()
    {
        return $this->prezime;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Korisnik
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
}
