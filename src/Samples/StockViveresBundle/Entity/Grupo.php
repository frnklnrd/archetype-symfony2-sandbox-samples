<?php

namespace Samples\StockViveresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grupo
 *
 * @ORM\Table(name="samples_stock_viveres__grupo")
 * @ORM\Entity
 */
class Grupo
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
     * @ORM\Column(name="numero_romano", type="string", length=5)
     */
    private $numero_romano;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string")
     */
    private $descricao;
	
    /**
     * @ORM\ManyToOne(targetEntity="Classe")
     * @ORM\JoinColumn(name="classe_id", referencedColumnName="id")
     */
    private $classe;
	
    /**
     * @ORM\ManyToOne(targetEntity="Classificacao")
     * @ORM\JoinColumn(name="classificacao_id", referencedColumnName="id")
     */
    private $classificacao;	

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
     * Set numero_romano
     *
     * @param string $numeroRomano
     * @return Grupo
     */
    public function setNumeroRomano($numeroRomano)
    {
        $this->numero_romano = $numeroRomano;

        return $this;
    }

    /**
     * Get numero_romano
     *
     * @return string 
     */
    public function getNumeroRomano()
    {
        return $this->numero_romano;
    }

    /**
     * Get numero_romano
     *
     * @return string 
     */
    public function getGrupo()
    {
        return "Grupo ".$this->numero_romano." - ".$this->nome;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Grupo
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
     * Set descricao
     *
     * @param string $descricao
     * @return Grupo
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
     * Set classe
     *
     * @param \Samples\StockViveresBundle\Entity\Classe $classe
     * @return Grupo
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
     * Set classificacao
     *
     * @param \Samples\StockViveresBundle\Entity\Classificacao $classificacao
     * @return Grupo
     */
    public function setClassificacao(\Samples\StockViveresBundle\Entity\Classificacao $classificacao = null)
    {
        $this->classificacao = $classificacao;

        return $this;
    }

    /**
     * Get classificacao
     *
     * @return \Samples\StockViveresBundle\Entity\Classificacao 
     */
    public function getClassificacao()
    {
        return $this->classificacao;
    }
	
	public function __toString()
	{
		return $this->id?$this->classe." - Grupo ".$this->numero_romano." - ".$this->nome:"";
	}

}
