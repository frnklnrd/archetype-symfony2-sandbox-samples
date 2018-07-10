<?php

namespace Samples\FarmaciaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Movimiento
 *
 * @ORM\Table(name="samples_farmacia__movimento")
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
     * @param \Samples\FarmaciaBundle\Entity\Produto $produto
     * @return Movimiento
     */
    public function setProduto(\Samples\FarmaciaBundle\Entity\Produto $produto = null)
    {
        $this->produto = $produto;

        return $this;
    }

    /**
     * Get produto
     *
     * @return \Samples\FarmaciaBundle\Entity\Produto 
     */
    public function getProduto()
    {
        return $this->produto;
    }

    /**
     * Set tipo_movimento
     *
     * @param \Samples\FarmaciaBundle\Entity\TipoMovimento $tipoMovimento
     * @return Movimento
     */
    public function setTipoMovimento(\Samples\FarmaciaBundle\Entity\TipoMovimento $tipoMovimento = null)
    {
        $this->tipo_movimento = $tipoMovimento;

        return $this;
    }

    /**
     * Get tipo_movimento
     *
     * @return \Samples\FarmaciaBundle\Entity\TipoMovimento 
     */
    public function getTipoMovimento()
    {
        return $this->tipo_movimento;
    }

    /**
     * Set funcionario
     *
     * @param \Samples\FarmaciaBundle\Entity\Funcionario $funcionario
     * @return Movimiento
     */
    public function setFuncionario(\Samples\FarmaciaBundle\Entity\Funcionario $funcionario = null)
    {
        $this->funcionario = $funcionario;

        return $this;
    }

    /**
     * Get funcionario
     *
     * @return \Samples\FarmaciaBundle\Entity\Funcionario 
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
}
