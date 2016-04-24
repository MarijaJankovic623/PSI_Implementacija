<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Opcija
 *
 * @Table(name="opcija")
 * @Entity
 */
class Opcija
{
    /**
     * @var integer
     *
     * @Column(name="IDOpcija", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idopcija;

    /**
     * @var string
     *
     * @Column(name="ImeOpcije", type="string", length=50, nullable=true)
     */
    private $imeopcije;


    /**
     * Get idopcija
     *
     * @return integer 
     */
    public function getIdopcija()
    {
        return $this->idopcija;
    }

    /**
     * Set imeopcije
     *
     * @param string $imeopcije
     * @return Opcija
     */
    public function setImeopcije($imeopcije)
    {
        $this->imeopcije = $imeopcije;
    
        return $this;
    }

    /**
     * Get imeopcije
     *
     * @return string 
     */
    public function getImeopcije()
    {
        return $this->imeopcije;
    }
}
