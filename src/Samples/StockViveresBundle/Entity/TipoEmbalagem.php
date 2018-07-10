<?php

namespace Samples\StockViveresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoEmbalagem
 *
 * @ORM\Table(name="samples_stock_viveres__tipo_embalagem")
 * @ORM\Entity
 */
class TipoEmbalagem
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
     * @return TipoEmbalagem
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
	
	public function __toString()
	{
		return $this->id?$this->nome:"";
	}
	
}
