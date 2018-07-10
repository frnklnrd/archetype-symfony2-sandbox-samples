<?php

namespace Samples\AvaliacaoDesempenhoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoPublicacao
 *
 * @ORM\Table(name="samples_avaliacao_desempenho__tipoproducaocientifica")
 * @ORM\Entity
 */
class TipoProducaoCientifica
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
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255)
     */
    private $tipo;


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
     * Set tipo
     *
     * @param string $tipo
     * @return TipoProducaoCientifica
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }
    
    public function __toString() {
        return $this->id?"".$this->tipo:"";
    }    
    
}
