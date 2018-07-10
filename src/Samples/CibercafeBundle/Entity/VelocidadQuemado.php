<?php

namespace Samples\CibercafeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_cibercafe__velocidad_quemado")
 */
class VelocidadQuemado {

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="velocidad", type="string")
     */
    private $velocidad;

    public function __toString() {
        return $this->getVelocidad();
    }


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
     * Set velocidad
     *
     * @param string $velocidad
     * @return VelocidadQuemado
     */
    public function setVelocidad($velocidad)
    {
        $this->velocidad = $velocidad;
    
        return $this;
    }

    /**
     * Get velocidad
     *
     * @return string 
     */
    public function getVelocidad()
    {
        return $this->velocidad;
    }
}