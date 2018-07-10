<?php

namespace Samples\CibercafeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="samples_cibercafe__servicio_reservacion_salon_conferencia")
  */
class ServicioReservacionSalonConferencia extends ServicioReservacion
{
    public function getTipo() {
        return "Reservación de Salón";
    }
}