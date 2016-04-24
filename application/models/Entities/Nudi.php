<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Nudi
 *
 * @Table(name="nudi")
 * @Entity
 */
class Nudi
{
    /**
     * @var integer
     *
     * @Column(name="IDNudi", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idnudi;

    /**
     * @var \Opcija
     *
     * @ManyToOne(targetEntity="Opcija")
     * @JoinColumns({
     *   @JoinColumn(name="IDOpcijaFK", referencedColumnName="IDOpcija")
     * })
     */
    private $idopcijafk;

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
     * Get idnudi
     *
     * @return integer 
     */
    public function getIdnudi()
    {
        return $this->idnudi;
    }

    /**
     * Set idopcijafk
     *
     * @param \Opcija $idopcijafk
     * @return Nudi
     */
    public function setIdopcijafk(\Opcija $idopcijafk = null)
    {
        $this->idopcijafk = $idopcijafk;
    
        return $this;
    }

    /**
     * Get idopcijafk
     *
     * @return \Opcija 
     */
    public function getIdopcijafk()
    {
        return $this->idopcijafk;
    }

    /**
     * Set idrestoranfk
     *
     * @param \Restoran $idrestoranfk
     * @return Nudi
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
