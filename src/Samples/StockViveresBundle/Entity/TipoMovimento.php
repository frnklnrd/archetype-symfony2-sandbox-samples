<?php

namespace Samples\StockViveresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoMovimento
 *
 * @ORM\Table(name="samples_stock_viveres__tipo_movimento")
 * @ORM\Entity
 */
class TipoMovimento
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
     * @var integer
     *
     * @ORM\Column(name="valor", type="integer")
     */
    private $valor;


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
     * @return TipoMovimento
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
     * Set valor
     *
     * @param integer $valor
     * @return TipoMovimento
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return integer 
     */
    public function getValor()
    {
        return $this->valor;
    }
	
	public function __toString()
	{
		return $this->id?$this->nome." (".$this->getTipo().")":"";
	}
	
    public function getTipo()
    {
		$tipos = array("1"=>"Entrada","-1"=>"Saída");
		$pos = "".$this->valor;
        return $tipos[$pos];
    }

	
	
}
