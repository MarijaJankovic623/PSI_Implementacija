<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Nalazise
 *
 * @Table(name="nalazise")
 * @Entity
 */
class Nalazise
{
    /**
     * @var integer
     *
     * @Column(name="IDNalaziSe", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idnalazise;

    /**
     * @var \Opstina
     *
     * @ManyToOne(targetEntity="Opstina")
     * @JoinColumns({
     *   @JoinColumn(name="IDOpstinaFK", referencedColumnName="IDOpstina")
     * })
     */
    private $idopstinafk;

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
     * Get idnalazise
     *
     * @return integer 
     */
    public function getIdnalazise()
    {
        return $this->idnalazise;
    }

    /**
     * Set idopstinafk
     *
     * @param \Opstina $idopstinafk
     * @return Nalazise
     */
    public function setIdopstinafk(\Opstina $idopstinafk = null)
    {
        $this->idopstinafk = $idopstinafk;
    
        return $this;
    }

    /**
     * Get idopstinafk
     *
     * @return \Opstina 
     */
    public function getIdopstinafk()
    {
        return $this->idopstinafk;
    }

    /**
     * Set idrestoranfk
     *
     * @param \Restoran $idrestoranfk
     * @return Nalazise
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
