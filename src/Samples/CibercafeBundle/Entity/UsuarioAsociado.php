<?php

namespace Samples\CibercafeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_cibercafe__usuario_asociado")
 */
class UsuarioAsociado extends Usuario {

    /**
     * @ORM\Column(name="cant_annos", type="integer", nullable=false)
     */
    private $cant_annos;

    /**
     * @ORM\ManyToOne(targetEntity="CategoriaUsuarioAsociado", inversedBy="UsuarioAsociado")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id", nullable=false)
     */
    private $categoria;

    public function __toString() {
        return $this->getNombre();
    }


   /**
     * Set cant_annos
     *
     * @param integer $cantAnnos
     * @return UsuarioAsociado
     */
    public function setCantAnnos($cantAnnos)
    {
        $this->cant_annos = $cantAnnos;
    
        return $this;
    }

    /**
     * Get cant_annos
     *
     * @return integer 
     */
    public function getCantAnnos()
    {
        return $this->cant_annos;
    }

    /**
     * Set categoria
     *
     * @param \Samples\CibercafeBundle\Entity\CategoriaUsuarioAsociado $categoria
     * @return UsuarioAsociado
     */
    public function setCategoria(\Samples\CibercafeBundle\Entity\CategoriaUsuarioAsociado $categoria)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return \Samples\CibercafeBundle\Entity\CategoriaUsuarioAsociado 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }
    
    public function getTipo() {
        return "Asociado";
    }    
}