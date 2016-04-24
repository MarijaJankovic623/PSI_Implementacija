<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Konobar
 *
 * @Table(name="konobar")
 * @Entity
 */
class Konobar
{
    /**
     * @var integer
     *
     * @Column(name="IDKonobar", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idkonobar;

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
     * @var \Restoran
     *
     * @ManyToOne(targetEntity="Restoran")
     * @JoinColumns({
     *   @JoinColumn(name="IDRestoranFK", referencedColumnName="IDRestoran")
     * })
     */
    private $idrestoranfk;


    /**
     * Get idkonobar
     *
     * @return integer 
     */
    public function getIdkonobar()
    {
        return $this->idkonobar;
    }

    /**
     * Set kime
     *
     * @param string $kime
     * @return Konobar
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
     * @return Konobar
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
     * @return Konobar
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
     * @return Konobar
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
     * @return Konobar
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

    /**
     * Set idrestoranfk
     *
     * @param \Restoran $idrestoranfk
     * @return Konobar
     */
    public function setIdrestoranfk(\Restoran $idrestoranfk = null)
    {
        $this->idrestoranfk = $idrestoranfk;
    
        return $this;
    }

    /**
     * Get idrestoranfk
     *
     * @return \Restoran 
     */
    public function getIdrestoranfk()
    {
        return $this->idrestoranfk;
    }
}
