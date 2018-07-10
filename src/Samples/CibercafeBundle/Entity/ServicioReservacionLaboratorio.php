<?php

namespace Samples\CibercafeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_cibercafe__servicio_reservacion_laboratorio")
 */
class ServicioReservacionLaboratorio extends ServicioReservacion {

   /**
     * @ORM\ManyToMany(targetEntity="Instalador")
     * @ORM\JoinTable(name="samples_cibercafe__servicio_reservacion_laboratorio_instalador", 
     *           joinColumns={@ORM\JoinColumn(name="servicio_laboratorio_id", referencedColumnName="id")},
     *           inverseJoinColumns={@ORM\JoinColumn(name="instalador_id",referencedColumnName="id")})
     * @Assert\Count(min=1, minMessage="Debe elegir al menos {{ limit }} instalador")
     */
    private $instaladores_necesarios;
    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->instaladores_necesarios = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
   /**
     * Add instaladores_necesarios
     *
     * @param \Samples\CibercafeBundle\Entity\Instalador $instaladoresNecesarios
     * @return ServicioReservacionLaboratorio
     */
    public function addInstaladoresNecesario(\Samples\CibercafeBundle\Entity\Instalador $instaladoresNecesarios)
    {
        $this->instaladores_necesarios[] = $instaladoresNecesarios;
    
        return $this;
    }

    /**
     * Remove instaladores_necesarios
     *
     * @param \Samples\CibercafeBundle\Entity\Instalador $instaladoresNecesarios
     */
    public function removeInstaladoresNecesario(\Samples\CibercafeBundle\Entity\Instalador $instaladoresNecesarios)
    {
        $this->instaladores_necesarios->removeElement($instaladoresNecesarios);
    }

    /**
     * Get instaladores_necesarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInstaladoresNecesarios()
    {
        return $this->instaladores_necesarios;
    }
    
    public function getTipo() {
        return "Reservación de Laboratorios";
    }
}