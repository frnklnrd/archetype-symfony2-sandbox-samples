<?php

namespace Samples\CibercafeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_cibercafe__servicio_quemado")
 */
class ServicioQuemado extends Servicio {

    /**
     * @ORM\ManyToOne(targetEntity="VelocidadQuemado", inversedBy="ServicioQuemado")
     * @ORM\JoinColumn(name="velocidad_id", referencedColumnName="id", nullable=false)
     */
    private $tipo_velocidad;

    /**
     * @ORM\Column(name="cant_inf_mb", type="string", length=50, nullable=false)
     */
    private $cant_inf_mb;

    /**
     * Set cant_inf_mb
     *
     * @param string $cantInfMb
     * @return ServicioQuemado
     */
    public function setCantInfMb($cantInfMb) {
        $this->cant_inf_mb = $cantInfMb;

        return $this;
    }

    /**
     * Get cant_inf_mb
     *
     * @return string 
     */
    public function getCantInfMb() {
        return $this->cant_inf_mb;
    }

    /**
     * Set tipo_velocidad
     *
     * @param \Samples\CibercafeBundle\Entity\VelocidadQuemado $tipoVelocidad
     * @return ServicioQuemado
     */
    public function setTipoVelocidad(\Samples\CibercafeBundle\Entity\VelocidadQuemado $tipoVelocidad) {
        $this->tipo_velocidad = $tipoVelocidad;

        return $this;
    }

    /**
     * Get tipo_velocidad
     *
     * @return \Samples\CibercafeBundle\Entity\VelocidadQuemado 
     */
    public function getTipoVelocidad() {
        return $this->tipo_velocidad;
    }

    public function getPrecio() {

        if ($this->usuario instanceof UsuarioAsociado && $this->usuario->getCategoria()->getId() < 3) {
            return $this->cant_inf_mb / 700;
        } else {
            // quitarle la letra x a la velocidad desde la posicion 0 hasta la longitud-1
            $velocidad = (int) substr($this->tipo_velocidad->getVelocidad(), 0, strlen($this->tipo_velocidad->getVelocidad()) - 1);
            return $velocidad / 16 + $this->cant_inf_mb / 700;
        }
    }

    public function getTipo() {
        return "Quemado CD/DVD";
    }
}