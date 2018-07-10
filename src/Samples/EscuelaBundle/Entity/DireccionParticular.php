<?php

namespace Samples\EscuelaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_escuela__direccion_particular")
 */
class DireccionParticular {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    protected $calle;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    protected $numero;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $localidad;

    /**
     * @ORM\ManyToOne(targetEntity="Provincia")
     * @ORM\JoinColumn(name="provincia_id", referencedColumnName="id", nullable=false)
     */
    protected $provincia;

    /**
     * @ORM\OneToOne(targetEntity="Persona")
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id", nullable=false)
     */
    private $persona;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;

        return $this;
    }
    
    /**
     * Set calle
     *
     * @param string $calle
     * @return DireccionParticular
     */
    public function setCalle($calle) {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get calle
     *
     * @return string 
     */
    public function getCalle() {
        return $this->calle;
    }

    /**
     * Set numero
     *
     * @param string $numero
     * @return DireccionParticular
     */
    public function setNumero($numero) {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero() {
        return $this->numero;
    }

    /**
     * Set localidad
     *
     * @param string $localidad
     * @return DireccionParticular
     */
    public function setLocalidad($localidad) {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidad
     *
     * @return string 
     */
    public function getLocalidad() {
        return $this->localidad;
    }

    /**
     * Set provincia
     *
     * @param \Samples\EscuelaBundle\Entity\Provincia $provincia
     * @return DireccionParticular
     */
    public function setProvincia(\Samples\EscuelaBundle\Entity\Provincia $provincia = null) {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return \Samples\EscuelaBundle\Entity\Provincia 
     */
    public function getProvincia() {
        return $this->provincia;
    }

    public function __toString() {
        return $this->getCalle() . " # " . $this->getNumero() . ". " . $this->getLocalidad(); //.". ".$this->getProvincia();
    }


    /**
     * Set persona
     *
     * @param \Samples\EscuelaBundle\Entity\Persona $persona
     * @return DireccionParticular
     */
    public function setPersona(\Samples\EscuelaBundle\Entity\Persona $persona)
    {
        $this->persona = $persona;
    
        return $this;
    }

    /**
     * Get persona
     *
     * @return \Samples\EscuelaBundle\Entity\Persona 
     */
    public function getPersona()
    {
        return $this->persona;
    }
}