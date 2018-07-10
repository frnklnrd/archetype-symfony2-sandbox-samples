<?php

namespace Samples\AvaliacaoDesempenhoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObtencaoGrauAcademico
 *
 * @ORM\Table(name="samples_avaliacao_desempenho__grauacademicoobtido")
 * @ORM\Entity
 */
class GrauAcademicoObtido
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
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date")
     */
    private $data;

    /**
     * @ORM\ManyToOne(targetEntity="Pessoal")
     * @ORM\JoinColumn(name="pessoal_id", referencedColumnName="id")
     */
    protected $pessoal;
    
    /**
     * @ORM\ManyToOne(targetEntity="GrauAcademico")
     * @ORM\JoinColumn(name="grau_academico_id", referencedColumnName="id")
     */
    protected $grau_academico;
    
    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=255)
     */
    private $descricao;


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
     * Set data
     *
     * @param \DateTime $data
     * @return ObtencaoGrauAcademico
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     * @return ObtencaoGrauAcademico
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set pessoal
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\Pessoal $pessoal
     * @return ObtencaoGrauAcademico
     */
    public function setPessoal(\Samples\AvaliacaoDesempenhoBundle\Entity\Pessoal $pessoal = null)
    {
        $this->pessoal = $pessoal;

        return $this;
    }

    /**
     * Get pessoal
     *
     * @return \Samples\AvaliacaoDesempenhoBundle\Entity\Pessoal 
     */
    public function getPessoal()
    {
        return $this->pessoal;
    }

    /**
     * Set grau_academico
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\GrauAcademico $grauAcademico
     * @return ObtencaoGrauAcademico
     */
    public function setGrauAcademico(\Samples\AvaliacaoDesempenhoBundle\Entity\GrauAcademico $grauAcademico = null)
    {
        $this->grau_academico = $grauAcademico;

        return $this;
    }

    /**
     * Get grau_academico
     *
     * @return \Samples\AvaliacaoDesempenhoBundle\Entity\GrauAcademico 
     */
    public function getGrauAcademico()
    {
        return $this->grau_academico;
    }
}
