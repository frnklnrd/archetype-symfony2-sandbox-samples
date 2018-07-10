<?php

namespace Samples\StockViveresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produto
 *
 * @ORM\Table(name="samples_stock_viveres__produto")
 * @ORM\Entity
 */
class Produto
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
     * @ORM\Column(name="codigo", type="string", length=255)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\ManyToOne(targetEntity="TipoProduto")
     * @ORM\JoinColumn(name="tipo_produto_id", referencedColumnName="id")
     */
    private $tipo_produto;
	
    /**
     * @ORM\ManyToOne(targetEntity="TipoEmbalagem")
     * @ORM\JoinColumn(name="tipo_embalagem_id", referencedColumnName="id")
     */
    private $tipo_embalagem;
	
        /**
     * @var float
     *
     * @ORM\Column(name="unidades_por_embalagem", type="float", nullable=true)
     */
    private $unidades_por_embalagem;

	/**
     * @var float
     *
     * @ORM\Column(name="peso_por_unidade", type="float", nullable=true)
     */
    private $peso_por_unidade;

    /**
     * @ORM\ManyToOne(targetEntity="UnidadeMedida")
     * @ORM\JoinColumn(name="unidade_medida_id", referencedColumnName="id")
     */
    private $unidade_medida;

    /**
     * @ORM\OneToOne(targetEntity="Existencia", cascade={"all"})
     * @ORM\JoinColumn(name="existencia_id", referencedColumnName="id", nullable=false)
     */
    private $existencia;

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
     * Set codigo
     *
     * @param string $codigo
     * @return Produto
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Produto
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
     * Set unidades_por_embalagem
     *
     * @param float $unidadesPorEmbalagem
     * @return Produto
     */
    public function setUnidadesPorEmbalagem($unidadesPorEmbalagem)
    {
        $this->unidades_por_embalagem = $unidadesPorEmbalagem;

        return $this;
    }

    /**
     * Get unidades_por_embalagem
     *
     * @return float 
     */
    public function getUnidadesPorEmbalagem()
    {
        return $this->unidades_por_embalagem;
    }

    /**
     * Set peso_por_unidade
     *
     * @param float $pesoPorUnidade
     * @return Produto
     */
    public function setPesoPorUnidade($pesoPorUnidade)
    {
        $this->peso_por_unidade = $pesoPorUnidade;

        return $this;
    }

    /**
     * Get peso_por_unidade
     *
     * @return float 
     */
    public function getPesoPorUnidade()
    {
        return $this->peso_por_unidade;
    }

    /**
     * Set tipo_produto
     *
     * @param \Samples\StockViveresBundle\Entity\TipoProduto $tipoProduto
     * @return Produto
     */
    public function setTipoProduto(\Samples\StockViveresBundle\Entity\TipoProduto $tipoProduto = null)
    {
        $this->tipo_produto = $tipoProduto;

        return $this;
    }

    /**
     * Get tipo_produto
     *
     * @return \Samples\StockViveresBundle\Entity\TipoProduto 
     */
    public function getTipoProduto()
    {
        return $this->tipo_produto;
    }

    /**
     * Set tipo_embalagem
     *
     * @param \Samples\StockViveresBundle\Entity\TipoEmbalagem $tipoEmbalagem
     * @return Produto
     */
    public function setTipoEmbalagem(\Samples\StockViveresBundle\Entity\TipoEmbalagem $tipoEmbalagem = null)
    {
        $this->tipo_embalagem = $tipoEmbalagem;

        return $this;
    }

    /**
     * Get tipo_embalagem
     *
     * @return \Samples\StockViveresBundle\Entity\TipoEmbalagem 
     */
    public function getTipoEmbalagem()
    {
        return $this->tipo_embalagem;
    }

    /**
     * Set unidade_medida
     *
     * @param \Samples\StockViveresBundle\Entity\UnidadeMedida $unidadeMedida
     * @return TipoProduto
     */
    public function setUnidadeMedida(\Samples\StockViveresBundle\Entity\UnidadeMedida $unidadeMedida = null)
    {
        $this->unidade_medida = $unidadeMedida;

        return $this;
    }

    /**
     * Get unidade_medida
     *
     * @return \Samples\StockViveresBundle\Entity\UnidadeMedida 
     */
    public function getUnidadeMedida()
    {
        return $this->unidade_medida;
    }

    /**
     * Set existencia
     *
     * @param \Samples\StockViveresBundle\Entity\Existencia $existencia
     * @return Produto
     */
    public function setExistencia(\Samples\StockViveresBundle\Entity\Existencia $existencia)
    {
        $this->existencia = $existencia;

        return $this;
    }

    /**
     * Get existencia
     *
     * @return \Samples\StockViveresBundle\Entity\Existencia 
     */
    public function getExistencia()
    {
        return $this->existencia;
    }
	
	public function __toString()
	{
		return $this->id?$this->codigo." - ".$this->nome." [ Stock: ".$this->getExistenciaEmbalagem()." ]":"";
	}
	
	public function getExistenciaEmbalagem()
	{
		return $this->existencia->getExistencia()." ".$this->tipo_embalagem."(s)";
	}
	
	public function getUnidadesTotal()
	{
		return ($this->existencia->getExistencia()*$this->unidades_por_embalagem)." unidade(s)";
	}
	
	public function getQuantidadeNetaTotal()
	{
		return ($this->existencia->getExistencia()*$this->unidades_por_embalagem*$this->peso_por_unidade)." ".$this->unidade_medida;
	}

}
