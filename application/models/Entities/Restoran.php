<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Restoran
 *
 * @Table(name="restoran")
 * @Entity
 */
class Restoran
{
    /**
     * @var integer
     *
     * @Column(name="IDRestoran", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idrestoran;

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
     * @Column(name="ImeObjekta", type="string", length=50, nullable=true)
     */
    private $imeobjekta;

    /**
     * @var string
     *
     * @Column(name="ImeVlasnika", type="string", length=50, nullable=true)
     */
    private $imevlasnika;

    /**
     * @var string
     *
     * @Column(name="PrezimeVlasnika", type="string", length=50, nullable=true)
     */
    private $prezimevlasnika;

    /**
     * @var string
     *
     * @Column(name="Email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var float
     *
     * @Column(name="Ocena", type="float", nullable=true)
     */
    private $ocena;

    /**
     * @var integer
     *
     * @Column(name="KodKonobara", type="integer", nullable=true)
     */
    private $kodkonobara;

    /**
     * @var string
     *
     * @Column(name="Cena", type="string", length=1, nullable=true)
     */
    private $cena;

    /**
     * @var string
     *
     * @Column(name="Slike", type="string", length=50, nullable=true)
     */
    private $slike;

    /**
     * @var integer
     *
     * @Column(name="BrojPosetilaca", type="integer", nullable=true)
     */
    private $brojposetilaca;


    /**
     * Get idrestoran
     *
     * @return integer 
     */
    public function getIdrestoran()
    {
        return $this->idrestoran;
    }

    /**
     * Set kime
     *
     * @param string $kime
     * @return Restoran
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
     * @return Restoran
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
     * Set imeobjekta
     *
     * @param string $imeobjekta
     * @return Restoran
     */
    public function setImeobjekta($imeobjekta)
    {
        $this->imeobjekta = $imeobjekta;
    
        return $this;
    }

    /**
     * Get imeobjekta
     *
     * @return string 
     */
    public function getImeobjekta()
    {
        return $this->imeobjekta;
    }

    /**
     * Set imevlasnika
     *
     * @param string $imevlasnika
     * @return Restoran
     */
    public function setImevlasnika($imevlasnika)
    {
        $this->imevlasnika = $imevlasnika;
    
        return $this;
    }

    /**
     * Get imevlasnika
     *
     * @return string 
     */
    public function getImevlasnika()
    {
        return $this->imevlasnika;
    }

    /**
     * Set prezimevlasnika
     *
     * @param string $prezimevlasnika
     * @return Restoran
     */
    public function setPrezimevlasnika($prezimevlasnika)
    {
        $this->prezimevlasnika = $prezimevlasnika;
    
        return $this;
    }

    /**
     * Get prezimevlasnika
     *
     * @return string 
     */
    public function getPrezimevlasnika()
    {
        return $this->prezimevlasnika;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Restoran
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
     * Set ocena
     *
     * @param float $ocena
     * @return Restoran
     */
    public function setOcena($ocena)
    {
        $this->ocena = $ocena;
    
        return $this;
    }

    /**
     * Get ocena
     *
     * @return float 
     */
    public function getOcena()
    {
        return $this->ocena;
    }

    /**
     * Set kodkonobara
     *
     * @param integer $kodkonobara
     * @return Restoran
     */
    public function setKodkonobara($kodkonobara)
    {
        $this->kodkonobara = $kodkonobara;
    
        return $this;
    }

    /**
     * Get kodkonobara
     *
     * @return integer 
     */
    public function getKodkonobara()
    {
        return $this->kodkonobara;
    }

    /**
     * Set cena
     *
     * @param string $cena
     * @return Restoran
     */
    public function setCena($cena)
    {
        $this->cena = $cena;
    
        return $this;
    }

    /**
     * Get cena
     *
     * @return string 
     */
    public function getCena()
    {
        return $this->cena;
    }

    /**
     * Set slike
     *
     * @param string $slike
     * @return Restoran
     */
    public function setSlike($slike)
    {
        $this->slike = $slike;
    
        return $this;
    }

    /**
     * Get slike
     *
     * @return string 
     */
    public function getSlike()
    {
        return $this->slike;
    }

    /**
     * Set brojposetilaca
     *
     * @param integer $brojposetilaca
     * @return Restoran
     */
    public function setBrojposetilaca($brojposetilaca)
    {
        $this->brojposetilaca = $brojposetilaca;
    
        return $this;
    }

    /**
     * Get brojposetilaca
     *
     * @return integer 
     */
    public function getBrojposetilaca()
    {
        return $this->brojposetilaca;
    }
    
    

}
