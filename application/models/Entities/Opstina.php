<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Opstina
 *
 * @Table(name="opstina")
 * @Entity
 */
class Opstina
{
    /**
     * @var integer
     *
     * @Column(name="IDOpstina", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $idopstina;

    /**
     * @var string
     *
     * @Column(name="Naziv", type="string", length=50, nullable=true)
     */
    private $naziv;


    /**
     * Get idopstina
     *
     * @return integer 
     */
    public function getIdopstina()
    {
        return $this->idopstina;
    }

    /**
     * Set naziv
     *
     * @param string $naziv
     * @return Opstina
     */
    public function setNaziv($naziv)
    {
        $this->naziv = $naziv;
    
        return $this;
    }

    /**
     * Get naziv
     *
     * @return string 
     */
    public function getNaziv()
    {
        return $this->naziv;
    }
}
