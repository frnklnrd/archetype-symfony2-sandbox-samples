<?php

namespace Samples\CibercafeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_cibercafe__servicio_navegacion")
 */
class ServicioNavegacion extends Servicio {

    /**
     * @ORM\Column(name="cant_kb_descarga", type="integer")
     */
    private $cant_kb_descarga;

    /**
     * Set cant_kb_descarga
     *
     * @param integer $cantKbDescarga
     * @return ServicioNavegacion
     */
    public function setCantKbDescarga($cantKbDescarga) {
        $this->cant_kb_descarga = $cantKbDescarga;

        return $this;
    }

    /**
     * Get cant_kb_descarga
     *
     * @return integer 
     */
    public function getCantKbDescarga() {
        return $this->cant_kb_descarga;
    }

    public function getPrecio() {
        //  $this->hora_fin - $this->hora_inicio; *1.5 + $this->cant_kb_descarga*2;

        $diferencia = $this->hora_fin->diff($this->hora_inicio);

        //$minutos = (int) ($diferencia->format("%i"));
        $horas = (int) ($diferencia->format("%H"));

        if ($this->usuario instanceof UsuarioEventual) {
            $precio = ($horas /*                     * 60 + $minutos */) * 1.5 + $this->cant_kb_descarga * 2;
        } else {
            $precio = ($horas /*                     * 60 + $minutos */) + $this->cant_kb_descarga * 2;
        }

        return $precio;
    }

    public function getTipo() {
        return "Navegación";
    }
}