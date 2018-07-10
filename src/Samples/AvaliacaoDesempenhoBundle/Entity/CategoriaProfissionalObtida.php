<?php

namespace Samples\AvaliacaoDesempenhoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObtencaoCategoria
 *
 * @ORM\Table(name="samples_avaliacao_desempenho__categoriaprofissionalobtida")
 * @ORM\Entity
 */
class CategoriaProfissionalObtida
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
     * @ORM\ManyToOne(targetEntity="CategoriaProfissional")
     * @ORM\JoinColumn(name="categoria_profissional_id", referencedColumnName="id")
     */
    protected $categoria_profissional;
    
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
     * @return ObtencaoCategoria
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
     * @return CategoriaProfissionalObtida
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
     * @return CategoriaProfissionalObtida
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
     * Set categoria_profissional
     *
     * @param \Samples\AvaliacaoDesempenhoBundle\Entity\CategoriaProfissional $categoriaProfissional
     * @return CategoriaProfissionalObtida
     */
    public function setCategoriaProfissional(\Samples\AvaliacaoDesempenhoBundle\Entity\CategoriaProfissional $categoriaProfissional = null)
    {
        $this->categoria_profissional = $categoriaProfissional;

        return $this;
    }

    /**
     * Get categoria_profissional
     *
     * @return \Samples\AvaliacaoDesempenhoBundle\Entity\CategoriaProfissional 
     */
    public function getCategoriaProfissional()
    {
        return $this->categoria_profissional;
    }
}
