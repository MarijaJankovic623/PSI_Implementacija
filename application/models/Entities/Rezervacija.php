<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Rezervacija
 *
 * @Table(name="rezervacija")
 * @Entity
 */
class Rezervacija
{
    /**
     * @var integer
     *
     * @Column(name="IDRezervacija", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idrezervacija;

    /**
     * @var string
     *
     * @Column(name="Status", type="string", length=50, nullable=true)
     */
    private $status;

    /**
     * @var integer
     *
     * @Column(name="Ocena", type="integer", nullable=true)
     */
    private $ocena;

    /**
     * @var \DateTime
     *
     * @Column(name="VremeOd", type="datetime", nullable=true)
     */
    private $vremeod;

    /**
     * @var \DateTime
     *
     * @Column(name="VremeDo", type="datetime", nullable=true)
     */
    private $vremedo;

    /**
     * @var \Sto
     *
     * @ManyToOne(targetEntity="Sto")
     * @JoinColumns({
     *   @JoinColumn(name="IDStoFK", referencedColumnName="IDSto")
     * })
     */
    private $idstofk;

    /**
     * @var \Korisnik
     *
     * @ManyToOne(targetEntity="Korisnik")
     * @JoinColumns({
     *   @JoinColumn(name="IDKorisnikFK", referencedColumnName="IDKorisnik")
     * })
     */
    private $idkorisnikfk;


    /**
     * Get idrezervacija
     *
     * @return integer 
     */
    public function getIdrezervacija()
    {
        return $this->idrezervacija;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Rezervacija
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set ocena
     *
     * @param integer $ocena
     * @return Rezervacija
     */
    public function setOcena($ocena)
    {
        $this->ocena = $ocena;
    
        return $this;
    }

    /**
     * Get ocena
     *
     * @return integer 
     */
    public function getOcena()
    {
        return $this->ocena;
    }

    /**
     * Set vremeod
     *
     * @param \DateTime $vremeod
     * @return Rezervacija
     */
    public function setVremeod($vremeod)
    {
        $this->vremeod = $vremeod;
    
        return $this;
    }

    /**
     * Get vremeod
     *
     * @return \DateTime 
     */
    public function getVremeod()
    {
        return $this->vremeod;
    }

    /**
     * Set vremedo
     *
     * @param \DateTime $vremedo
     * @return Rezervacija
     */
    public function setVremedo($vremedo)
    {
        $this->vremedo = $vremedo;
    
        return $this;
    }

    /**
     * Get vremedo
     *
     * @return \DateTime 
     */
    public function getVremedo()
    {
        return $this->vremedo;
    }

    /**
     * Set idstofk
     *
     * @param \Sto $idstofk
     * @return Rezervacija
     */
    public function setIdstofk(\Sto $idstofk = null)
    {
        $this->idstofk = $idstofk;
    
        return $this;
    }

    /**
     * Get idstofk
     *
     * @return \Sto 
     */
    public function getIdstofk()
    {
        return $this->idstofk;
    }

    /**
     * Set idkorisnikfk
     *
     * @param \Korisnik $idkorisnikfk
     * @return Rezervacija
     */
    public function setIdkorisnikfk(\Korisnik $idkorisnikfk = null)
    {
        $this->idkorisnikfk = $idkorisnikfk;
    
        return $this;
    }

    /**
     * Get idkorisnikfk
     *
     * @return \Korisnik 
     */
    public function getIdkorisnikfk()
    {
        return $this->idkorisnikfk;
    }
}
