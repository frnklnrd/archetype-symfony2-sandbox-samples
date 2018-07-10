<?php

namespace Samples\EscuelaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_escuela__provincia")
 */
class Provincia {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true, nullable=false)
     * @Assert\NotBlank(message="No debe estar vacío")
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string", length=10, unique=true, nullable=false)
     * @Assert\NotBlank(message="No debe estar vacío")
     * @Assert\Length(min=3, max=3, exactMessage="Debe estar formado por {{ limit }} letras")
     */
    protected $abreviatura;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Provincia
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set abreviatura
     *
     * @param string $abreviatura
     * @return Provincia
     */
    public function setAbreviatura($abreviatura) {
        $this->abreviatura = $abreviatura;

        return $this;
    }

    /**
     * Get abreviatura
     *
     * @return string 
     */
    public function getAbreviatura() {
        return $this->abreviatura;
    }

    public function __toString() {
        return $this->getNombre();
    }

}