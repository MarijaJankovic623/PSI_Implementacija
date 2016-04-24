<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Sto
 *
 * @Table(name="sto")
 * @Entity
 */
class Sto
{
    /**
     * @var integer
     *
     * @Column(name="IDSto", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idsto;

    /**
     * @var integer
     *
     * @Column(name="BrojOsoba", type="integer", nullable=true)
     */
    private $brojosoba;

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
     * Get idsto
     *
     * @return integer 
     */
    public function getIdsto()
    {
        return $this->idsto;
    }

    /**
     * Set brojosoba
     *
     * @param integer $brojosoba
     * @return Sto
     */
    public function setBrojosoba($brojosoba)
    {
        $this->brojosoba = $brojosoba;
    
        return $this;
    }

    /**
     * Get brojosoba
     *
     * @return integer 
     */
    public function getBrojosoba()
    {
        return $this->brojosoba;
    }

    /**
     * Set idrestoranfk
     *
     * @param \Restoran $idrestoranfk
     * @return Sto
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
