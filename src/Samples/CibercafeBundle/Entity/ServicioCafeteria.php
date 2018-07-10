<?php

namespace Samples\CibercafeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_cibercafe__servicio_cafeteria")
 */
class ServicioCafeteria extends Servicio {

    /**
     * @ORM\ManyToMany(targetEntity="Menu")
     * @ORM\JoinTable(name="samples_cibercafe__plato_solicitado", 
     *           joinColumns={@ORM\JoinColumn(name="cafeteria_id", referencedColumnName="id")},
     *           inverseJoinColumns={@ORM\JoinColumn(name="menu_id",referencedColumnName="id")})
     * @Assert\Count(min=1, minMessage="Debe elegir al menos {{ limit }} plato")
     */
    private $platos_solicitados;

    /**
     * Constructor
     */
    public function __construct() {
        $this->platos_solicitados = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add platos_solicitados
     *
     * @param \Samples\CibercafeBundle\Entity\Menu $platosSolicitados
     * @return ServicioCafeteria
     */
    public function addPlatosSolicitado(\Samples\CibercafeBundle\Entity\Menu $platosSolicitados) {
        $this->platos_solicitados[] = $platosSolicitados;

        return $this;
    }

    /**
     * Remove platos_solicitados
     *
     * @param \Samples\CibercafeBundle\Entity\Menu $platosSolicitados
     */
    public function removePlatosSolicitado(\Samples\CibercafeBundle\Entity\Menu $platosSolicitados) {
        $this->platos_solicitados->removeElement($platosSolicitados);
    }

    /**
     * Get platos_solicitados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPlatosSolicitados() {
        return $this->platos_solicitados;
    }

    public function getPrecio() {
        $precio = 0;

        foreach ($this->getPlatosSolicitados() as $plato) {
            $precio+=$plato->getPrecio();
        }

        if ($this->getUsuario() instanceof UsuarioEventual)
            $precio = $precio * 1.5;

        return $precio;
    }

    public function getTipo() {
        return "Cafetería";
    }
}