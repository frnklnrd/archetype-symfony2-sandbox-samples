<?php

namespace Samples\StockViveresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoProduto
 *
 * @ORM\Table(name="samples_stock_viveres__tipo_produto")
 * @ORM\Entity
 */
class TipoProduto
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
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\ManyToOne(targetEntity="Classe")
     * @ORM\JoinColumn(name="classe_id", referencedColumnName="id")
     */
    private $classe;

    /**
     * @ORM\ManyToOne(targetEntity="Grupo")
     * @ORM\JoinColumn(name="grupo_id", referencedColumnName="id")
     */
    private $grupo;

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
     * Set nome
     *
     * @param string $nome
     * @return TipoProduto
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set classe
     *
     * @param \Samples\StockViveresBundle\Entity\Classe $classe
     * @return TipoProduto
     */
    public function setClasse(\Samples\StockViveresBundle\Entity\Classe $classe = null)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return \Samples\StockViveresBundle\Entity\Classe 
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * Set grupo
     *
     * @param \Samples\StockViveresBundle\Entity\Grupo $grupo
     * @return TipoProduto
     */
    public function setGrupo(\Samples\StockViveresBundle\Entity\Grupo $grupo = null)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return \Samples\StockViveresBundle\Entity\Grupo 
     */
    public function getGrupo()
    {
        return $this->grupo;
    }
	
	public function __toString()
	{
		return $this->id?$this->nome." (".$this->classe.")":"";
	}
	
}
