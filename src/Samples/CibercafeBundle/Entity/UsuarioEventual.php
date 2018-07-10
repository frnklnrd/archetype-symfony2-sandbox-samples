<?php

namespace Samples\CibercafeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_cibercafe__usuario_eventual")
 */
class UsuarioEventual extends Usuario {

    public function __toString() {
        return $this->getNombre();
    }

    public function getTipo() {
        return "Eventual";
    }
}