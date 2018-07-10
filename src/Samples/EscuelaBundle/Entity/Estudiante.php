<?php

namespace Samples\EscuelaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_escuela__estudiante")
 */
class Estudiante extends Persona {

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\Range(min=1, max=12, minMessage="Debe ser mayor o igual que {{ limit }}", maxMessage="Debe ser menor o igual que {{ limit }}", invalidMessage="Debe ser un número entre 1 y 12")
     * @Assert\Type(type="integer", message="Debe ser un valor entero")
     */
    private $grado;

    /**
     * @ORM\OneToMany(targetEntity="CursoRecibido", mappedBy="estudiante", cascade={"all"})
     */
    private $notas;

    /**
     * Set grado
     *
     * @param integer $grado
     * @return Estudiante
     */
    public function setGrado($grado) {
        $this->grado = $grado;

        return $this;
    }

    /**
     * Get grado
     *
     * @return integer 
     */
    public function getGrado() {
        return $this->grado;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->notas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add notas
     *
     * @param \Samples\EscuelaBundle\Entity\CursoRecibido $notas
     * @return Estudiante
     */
    public function addNota(\Samples\EscuelaBundle\Entity\CursoRecibido $notas) {
        $this->notas[] = $notas;

        return $this;
    }

    /**
     * Remove notas
     *
     * @param \Samples\EscuelaBundle\Entity\CursoRecibido $notas
     */
    public function removeNota(\Samples\EscuelaBundle\Entity\CursoRecibido $notas) {
        $this->notas->removeElement($notas);
    }

    /**
     * Get notas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNotas() {
        return $this->notas;
    }

    public function __toString() {
        return $this->getNombre() . " " . $this->getApellido1() . " " . $this->getApellido2();
    }

}
