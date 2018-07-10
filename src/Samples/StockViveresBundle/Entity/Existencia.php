<?php

namespace Samples\StockViveresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Existencia
 *
 * @ORM\Table(name="samples_stock_viveres__existencia")
 * @ORM\Entity
 */
class Existencia
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
     * @var float
     *
     * @ORM\Column(name="existencia", type="float")
     */
    private $existencia;

    /**
     * @ORM\OneToOne(targetEntity="Produto", mappedBy="existencia", cascade={"all"})
     */
    private $produto;	
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
     * @return Existencia
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
     * Set existencia
     *
     * @param float $existencia
     * @return Existencia
     */
    public function setExistencia($existencia)
    {
        $this->existencia = $existencia;

        return $this;
    }

    /**
     * Get existencia
     *
     * @return float 
     */
    public function getExistencia()
    {
        return $this->existencia;
    }
	
	public function __toString()
	{
		return $this->id?"".$this->existencia:"0";
	}

}
