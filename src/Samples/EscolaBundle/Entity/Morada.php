<?php

namespace Samples\EscolaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Morada
 *
 * @ORM\Table(name="samples_escola__morada")
 * @ORM\Entity
 */
class Morada
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
     * @ORM\Column(name="rua", type="string", length=255)
     */
    private $rua;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer")
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="bairro", type="string", length=255)
     */
    private $bairro;

    /**
     * @ORM\OneToOne(targetEntity="Estudante")
     * @ORM\JoinColumn(name="estudante_id", referencedColumnName="id", nullable=false)
     */
    private $estudante;
	
    /**
     * @ORM\ManyToOne(targetEntity="Provincia")
     * @ORM\JoinColumn(name="provincia_id", referencedColumnName="id")
     */
    private $provincia;

    /**
     * @ORM\ManyToOne(targetEntity="Municipio")
     * @ORM\JoinColumn(name="municipio_id", referencedColumnName="id")
     */
    private $municipio;

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
     * Set rua
     *
     * @param string $rua
     * @return Morada
     */
    public function setRua($rua)
    {
        $this->rua = $rua;

        return $this;
    }

    /**
     * Get rua
     *
     * @return string 
     */
    public function getRua()
    {
        return $this->rua;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     * @return Morada
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set bairro
     *
     * @param string $bairro
     * @return Morada
     */
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;

        return $this;
    }

    /**
     * Get bairro
     *
     * @return string 
     */
    public function getBairro()
    {
        return $this->bairro;
    }

    /**
     * Set estudante
     *
     * @param \Samples\EscolaBundle\Entity\Estudante $estudante
     * @return Morada
     */
    public function setEstudante(\Samples\EscolaBundle\Entity\Estudante $estudante)
    {
        $this->estudante = $estudante;

        return $this;
    }

    /**
     * Get estudante
     *
     * @return \Samples\EscolaBundle\Entity\Estudante 
     */
    public function getEstudante()
    {
        return $this->estudante;
    }

    /**
     * Set provincia
     *
     * @param \Samples\EscolaBundle\Entity\Provincia $provincia
     * @return Morada
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

    /**
     * Set municipio
     *
     * @param \Samples\EscolaBundle\Entity\Municipio $municipio
     * @return Morada
     */
    public function setMunicipio(\Samples\EscolaBundle\Entity\Municipio $municipio = null)
    {
        $this->municipio = $municipio;

        return $this;
    }

    /**
     * Get municipio
     *
     * @return \Samples\EscolaBundle\Entity\Municipio 
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }
	
    public function __toString()
    {
        return $this->id? $this->rua." ".$this->numero: "";
    }	
}
