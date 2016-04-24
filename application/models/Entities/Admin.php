<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Admin
 *
 * @Table(name="admin")
 * @Entity
 */
class Admin
{
    /**
     * @var integer
     *
     * @Column(name="IDAdmin", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idadmin;

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
     * @var integer
     *
     * @Column(name="KodAdmina", type="integer", nullable=true)
     */
    private $kodadmina;


    /**
     * Get idadmin
     *
     * @return integer 
     */
    public function getIdadmin()
    {
        return $this->idadmin;
    }

    /**
     * Set kime
     *
     * @param string $kime
     * @return Admin
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
     * @return Admin
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
     * @return Admin
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
     * @return Admin
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
     * @return Admin
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
     * Set kodadmina
     *
     * @param integer $kodadmina
     * @return Admin
     */
    public function setKodadmina($kodadmina)
    {
        $this->kodadmina = $kodadmina;
    
        return $this;
    }

    /**
     * Get kodadmina
     *
     * @return integer 
     */
    public function getKodadmina()
    {
        return $this->kodadmina;
    }
}
