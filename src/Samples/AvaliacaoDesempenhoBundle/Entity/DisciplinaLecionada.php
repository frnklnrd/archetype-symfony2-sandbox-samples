<?php

namespace Samples\AvaliacaoDesempenhoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DisciplinaLecionada
 *
 * @ORM\Table(name="samples_avaliacao_desempenho__disciplinalecionada")
 * @ORM\Entity
 */
class DisciplinaLecionada
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
     * @ORM\ManyToOne(targetEntity="AvaliacaoDesempenho")
     * @ORM\JoinColumn(name="avaliacao_desempenho_id", referencedColumnName="id")
     */
    protected $avaliacao_desempenho;
    
    /**
     * @ORM\ManyToOne(targetEntity="Disciplina")
     * @ORM\JoinColumn(name="disciplina_id", referencedColumnName="id")
     */
    protected $disciplina;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="semestre", type="integer")
     */
    private $semestre;


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
     * Set semestre
     *
     * @param integer $semestre
     * @return DisciplinaLecionada
     */
    public function setSemestre($semestre)
    {
        $this->semestre = $semestre;

        return $this;
    }

    /**
     * Get semestre
     *
     * @return integer 
     */
    public function getSemestre()
    {
        return $this->semestre;
    }

    /**
     * Set avaliacao_desempenho
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\AvaliacaoDesempenho $avaliacaoDesempenho
     * @return DisciplinaLecionada
     */
    public function setAvaliacaoDesempenho(\Samples\AvaliacaoDesempenhoBundle\Entity\AvaliacaoDesempenho $avaliacaoDesempenho = null)
    {
        $this->avaliacao_desempenho = $avaliacaoDesempenho;

        return $this;
    }

    /**
     * Get avaliacao_desempenho
     *
     * @return \Samples\AvaliacaoDesempenhoBundle\Entity\AvaliacaoDesempenho 
     */
    public function getAvaliacaoDesempenho()
    {
        return $this->avaliacao_desempenho;
    }

    /**
     * Set disciplina
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\Disciplina $disciplina
     * @return DisciplinaLecionada
     */
    public function setDisciplina(\Samples\AvaliacaoDesempenhoBundle\Entity\Disciplina $disciplina = null)
    {
        $this->disciplina = $disciplina;

        return $this;
    }

    /**
     * Get disciplina
     *
     * @return \Samples\AvaliacaoDesempenhoBundle\Entity\Disciplina 
     */
    public function getDisciplina()
    {
        return $this->disciplina;
    }
}
