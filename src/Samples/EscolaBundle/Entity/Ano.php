<?php

namespace Samples\EscolaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ano
 *
 * @ORM\Table(name="samples_escola__ano")
 * @ORM\Entity
 */
class Ano
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer")
     */
    private $numero;
	
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     * @return Ano
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }
	
    public function __toString()
    {
        return $this->id?(string)$this->numero:"";
    }
	
}
