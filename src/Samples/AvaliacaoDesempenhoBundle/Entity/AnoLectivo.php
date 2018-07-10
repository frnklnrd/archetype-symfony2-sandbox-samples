<?php

namespace Samples\AvaliacaoDesempenhoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnoLectivo
 *
 * @ORM\Table(name="samples_avaliacao_desempenho__anolectivo")
 * @ORM\Entity
 */
class AnoLectivo
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
     * @ORM\Column(name="ano", type="integer")
     */
    private $ano;


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
     * Set ano
     *
     * @param integer $ano
     * @return AnoLectivo
     */
    public function setAno($ano)
    {
        $this->ano = $ano;

        return $this;
    }

    /**
     * Get ano
     *
     * @return integer 
     */
    public function getAno()
    {
        return $this->ano;
    }
    
    public function __toString() {
        return $this->id?"".$this->ano:"";
    }    
}
