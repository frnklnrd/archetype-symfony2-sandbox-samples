<?php

namespace Samples\EscolaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pesquisa
 *
 * @ORM\Table(name="samples_escola__pesquisa")
 * @ORM\Entity
 */
class Pesquisa
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
     * @ORM\Column(name="data_entrega", type="date")
     */
    private $dataEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="tema", type="string", length=255)
     */
    private $tema;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantidade_paginas", type="integer")
     */
    private $quantidadePaginas;

    /**
     * @ORM\ManyToOne(targetEntity="Estudante")
     * @ORM\JoinColumn(name="estudante_id", referencedColumnName="id", nullable=false)
     */
    protected $estudante;	
	
    /**
     * @ORM\ManyToOne(targetEntity="TipoPesquisa")
     * @ORM\JoinColumn(name="tipo_pesquisa_id", referencedColumnName="id")
     */
    private $tipo_pesquisa;
	
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
     * Set dataEntrega
     *
     * @param \DateTime $dataEntrega
     * @return Pesquisa
     */
    public function setDataEntrega($dataEntrega)
    {
        $this->dataEntrega = $dataEntrega;

        return $this;
    }

    /**
     * Get dataEntrega
     *
     * @return \DateTime 
     */
    public function getDataEntrega()
    {
        return $this->dataEntrega;
    }

    /**
     * Set tema
     *
     * @param string $tema
     * @return Pesquisa
     */
    public function setTema($tema)
    {
        $this->tema = $tema;

        return $this;
    }

    /**
     * Get tema
     *
     * @return string 
     */
    public function getTema()
    {
        return $this->tema;
    }

    /**
     * Set quantidadePaginas
     *
     * @param integer $quantidadePaginas
     * @return Pesquisa
     */
    public function setQuantidadePaginas($quantidadePaginas)
    {
        $this->quantidadePaginas = $quantidadePaginas;

        return $this;
    }

    /**
     * Get quantidadePaginas
     *
     * @return integer 
     */
    public function getQuantidadePaginas()
    {
        return $this->quantidadePaginas;
    }

    /**
     * Set estudante
     *
     * @param \Samples\EscolaBundle\Entity\Estudante $estudante
     * @return Pesquisa
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
     * Set tipo_pesquisa
     *
     * @param \Samples\EscolaBundle\Entity\TipoPesquisa $tipoPesquisa
     * @return Pesquisa
     */
    public function setTipoPesquisa(\Samples\EscolaBundle\Entity\TipoPesquisa $tipoPesquisa = null)
    {
        $this->tipo_pesquisa = $tipoPesquisa;

        return $this;
    }

    /**
     * Get tipo_pesquisa
     *
     * @return \Samples\EscolaBundle\Entity\TipoPesquisa 
     */
    public function getTipoPesquisa()
    {
        return $this->tipo_pesquisa;
    }
	
    public function __toString()
    {
        return $this->id? $this->tema: "";
    }	
}
