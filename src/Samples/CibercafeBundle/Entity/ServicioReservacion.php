<?php

namespace Samples\CibercafeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_cibercafe__servicio_reservacion"), 
 */
abstract class ServicioReservacion extends Servicio {

    /**
     * @ORM\Column(name="entidad", type="string", length=50, nullable=false)
     */
    private $entidad;

    /**
     * Set entidad
     *
     * @param string $entidad
     * @return ServicioReservacion
     */
    public function setEntidad($entidad) {
        $this->entidad = $entidad;

        return $this;
    }

    /**
     * Get entidad
     *
     * @return string 
     */
    public function getEntidad() {
        return $this->entidad;
    }

    public function getTipo() {
        return "Reservación";
    }
}