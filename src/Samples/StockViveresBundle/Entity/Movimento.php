<?php

namespace Samples\StockViveresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movimiento
 *
 * @ORM\Table(name="samples_stock_viveres__movimento")
 * @ORM\Entity
 */
class Movimento
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
     * @ORM\ManyToOne(targetEntity="Produto")
     * @ORM\JoinColumn(name="produto_id", referencedColumnName="id")
     */
    private $produto;

    /**
     * @ORM\ManyToOne(targetEntity="TipoMovimento")
     * @ORM\JoinColumn(name="tipo_movimento_id", referencedColumnName="id")
     */
    private $tipo_movimento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime")
     */
    private $data;

	
    /**
     * @var float
     *
     * @ORM\Column(name="existencia_anterior", type="float")
     */
    private $existencia_anterior;

    /**
     * @var float
     *
     * @ORM\Column(name="existencia_actual", type="float")
     */
    private $existencia_actual;

    /**
     * @var float
     *
     * @ORM\Column(name="quantidade", type="float")
     */
    private $quantidade;

    /**
     * @var string
     *
     * @ORM\Column(name="procedencia_destino", type="string", length=255)
     */
    private $procedencia_destino;

    /**
     * @var string
     *
     * @ORM\Column(name="observacoes", type="string", length=255, nullable=true)
     */
    private $observacoes;

    /**
     * @ORM\ManyToOne(targetEntity="Funcionario")
     * @ORM\JoinColumn(name="funcionario_id", referencedColumnName="id")
     */
    private $funcionario;

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
     * @return Movimiento
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
     * Set existencia_anterior
     *
     * @param float $existenciaAnterior
     * @return Movimiento
     */
    public function setExistenciaAnterior($existenciaAnterior)
    {
        $this->existencia_anterior = $existenciaAnterior;

        return $this;
    }

    /**
     * Get existencia_anterior
     *
     * @return float 
     */
    public function getExistenciaAnterior()
    {
        return $this->existencia_anterior;
    }

    /**
     * Set existencia_actual
     *
     * @param float $existenciaActual
     * @return Movimiento
     */
    public function setExistenciaActual($existenciaActual)
    {
        $this->existencia_actual = $existenciaActual;

        return $this;
    }

    /**
     * Get existencia_actual
     *
     * @return float 
     */
    public function getExistenciaActual()
    {
        return $this->existencia_actual;
    }

    /**
     * Set quantidade
     *
     * @param float $quantidade
     * @return Movimiento
     */
    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    /**
     * Get quantidade
     *
     * @return float 
     */
    public function getQuantidade()
    {
        return $this->quantidade;
    }

    /**
     * Set procedencia_destino
     *
     * @param string $procedenciaDestino
     * @return Movimiento
     */
    public function setProcedenciaDestino($procedenciaDestino)
    {
        $this->procedencia_destino = $procedenciaDestino;

        return $this;
    }

    /**
     * Get procedencia_destino
     *
     * @return string 
     */
    public function getProcedenciaDestino()
    {
        return $this->procedencia_destino;
    }

    /**
     * Set observacoes
     *
     * @param string $observacoes
     * @return Movimiento
     */
    public function setObservacoes($observacoes)
    {
        $this->observacoes = $observacoes;

        return $this;
    }

    /**
     * Get observacoes
     *
     * @return string 
     */
    public function getObservacoes()
    {
        return $this->observacoes;
    }

    /**
     * Set produto
     *
     * @param \Samples\StockViveresBundle\Entity\Produto $produto
     * @return Movimiento
     */
    public function setProduto(\Samples\StockViveresBundle\Entity\Produto $produto = null)
    {
        $this->produto = $produto;

        return $this;
    }

    /**
     * Get produto
     *
     * @return \Samples\StockViveresBundle\Entity\Produto 
     */
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * Set tipo_movimento
     *
     * @param \Samples\StockViveresBundle\Entity\TipoMovimento $tipoMovimento
     * @return Movimento
     */
    public function setTipoMovimento(\Samples\StockViveresBundle\Entity\TipoMovimento $tipoMovimento = null)
    {
        $this->tipo_movimento = $tipoMovimento;

        return $this;
    }

    /**
     * Get tipo_movimento
     *
     * @return \Samples\StockViveresBundle\Entity\TipoMovimento 
     */
    public function getTipoMovimento()
    {
        return $this->tipo_movimento;
    }

    /**
     * Set funcionario
     *
     * @param \Samples\StockViveresBundle\Entity\Funcionario $funcionario
     * @return Movimiento
     */
    public function setFuncionario(\Samples\StockViveresBundle\Entity\Funcionario $funcionario = null)
    {
        $this->funcionario = $funcionario;

        return $this;
    }

    /**
     * Get funcionario
     *
     * @return \Samples\StockViveresBundle\Entity\Funcionario 
     */
    public function getFuncionario()
    {
        return $this->funcionario;
    }
	
	public function __toString()
	{
		return $this->id?$this->produto->getNome()." (".$this->tipo_movimento." - ".$this->quantidade." items - ".$this->data->format('d/m/Y'):"";
	}
	
	public function getDataFormat()
	{
		return $this->data->format('d/m/Y');
	}
	
	public function getQuantidadeMovimentada()
	{
		return $this->quantidade." ".$this->produto->getTipoEmbalagem()."(s)";
	}
	
	public function getExistenciaAntes()
	{
		return $this->existencia_anterior." ".$this->produto->getTipoEmbalagem()."(s)";
	}
	
	public function getExistenciaDepois()
	{
		return $this->existencia_actual." ".$this->produto->getTipoEmbalagem()."(s)";
	}
	
}
