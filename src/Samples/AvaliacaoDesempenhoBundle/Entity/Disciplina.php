<?php

namespace Samples\AvaliacaoDesempenhoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Disciplina
 *
 * @ORM\Table(name="samples_avaliacao_desempenho__disciplina")
 * @ORM\Entity
 */
class Disciplina
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
     * @ORM\Column(name="disciplina", type="string", length=255)
     */
    private $disciplina;

    /**
     * @ORM\ManyToOne(targetEntity="Departamento")
     * @ORM\JoinColumn(name="departamento_id", referencedColumnName="id")
     */
    protected $departamento;
    

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
     * Set disciplina
     *
     * @param string $disciplina
     * @return Disciplina
     */
    public function setDisciplina($disciplina)
    {
        $this->disciplina = $disciplina;

        return $this;
    }

    /**
     * Get disciplina
     *
     * @return string 
     */
    public function getDisciplina()
    {
        return $this->disciplina;
    }

    /**
     * Set departamento
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\Departamento $departamento
     * @return Disciplina
     */
    public function setDepartamento(\Samples\AvaliacaoDesempenhoBundle\Entity\Departamento $departamento = null)
    {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get departamento
     *
     * @return \Samples\AvaliacaoDesempenhoBundle\Entity\Departamento 
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }
    
    public function __toString() {
        return $this->id?"".$this->disciplina." (".$this->departamento->getAbreviatura().")":"";
    }    
    
}
