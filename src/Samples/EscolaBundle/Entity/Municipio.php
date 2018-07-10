<?php

namespace Samples\EscolaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Municipio
 *
 * @ORM\Table(name="samples_escola__municipio")
 * @ORM\Entity
 */
class Municipio
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
     * @ORM\ManyToOne(targetEntity="Provincia")
     * @ORM\JoinColumn(name="provincia_id", referencedColumnName="id")
     */
    private $provincia;

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
     * @return Municipio
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
     * Set provincia
     *
     * @param \Samples\EscolaBundle\Entity\Provincia $provincia
     * @return Municipio
     */
    public function setProvincia(\Samples\EscolaBundle\Entity\Provincia $provincia = null)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return \Samples\EscolaBundle\Entity\Provincia 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
	
    public function __toString()
    {
        return $this->id? $this->nome: "";
    }
}
